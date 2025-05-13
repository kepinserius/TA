<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Umkm;
use App\Models\Order;
use App\Models\OrderItems;
use App\Services\OrderService;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class XenditService
{
    private $xenditInvoiceApi;

    public function __construct() {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->xenditInvoiceApi = new InvoiceApi();
    }

    public function doublePayment($data) {
        $xenditIdPayment = Umkm::where('id', $data['children'][0]['merchant_id'])->first();
        $xenditIdSplit = Umkm::where('id', $data['children'][1]['merchant_id'])->first();

        $arraySplits[] = array(
            "flat_amount" => (float) $data['children'][1]['total'],
            "currency" => "IDR",
            "destination_account_id" => $xenditIdSplit['xendit_user_id'],
            "reference_id" => (string) Str::uuid()
        );

        $response_splits = $this->splits_rule($arraySplits);

        if (!isset($response_splits->json()['error_code'])) {
            $id = $response_splits->json()['id'];
            $data->splits_id = $id;
            $data->save();

            $response_ewallet = $this->ewalletCharge($data['id'], $id, $xenditIdPayment, $data['total'], $data['payment_method']);

            if (!isset($response_ewallet->json()['error_code'])) {
                $data->update([
                    'xendit_reference_id' => $response_ewallet->json()['id']
                ]);

                return $data['payment_method'] == 'ID_SHOPEEPAY' ? $response_ewallet->json()['actions']['mobile_deeplink_checkout_url'] : $response_ewallet->json()['actions']['desktop_web_checkout_url'];
            } else {
                dd($response_ewallet->json());
            }
        } else {
            dd($response_splits->json());
        }
    }

    public function multiplePayments($data) {
        $xenditIdPayment = Umkm::where('id', $data['children'][0]['merchant_id'])->first();
        $xenditIdSplit = Umkm::where('id', $data['children'][1]['merchant_id'])->first();

        $filterArray = array_slice($data['children']->toArray(), 1);

        $result = [];

        foreach ($filterArray as $key => $value) {
            $xenditIdSplit = Umkm::where('id', $value['merchant_id'])->first();
            $result[] = [
                "flat_amount" => (float) $value['total'],
                "currency" => "IDR",
                "destination_account_id" => $xenditIdSplit['xendit_user_id'],
                "reference_id" => (string) Str::uuid()
            ];
        };

        $arraySplits[] = array(
            "flat_amount" => (float) $data['children'][1]['total'],
            "currency" => "IDR",
            "destination_account_id" => $xenditIdSplit['xendit_user_id'],
            "reference_id" => (string) Str::uuid()
        );
        
        $response_splits = $this->splits_rule($result);

        if (!isset($response_splits->json()['error_code'])) {
            $id = $response_splits->json()['id'];
            $data->splits_id = $id;
            $data->save();

            $response_ewallet = $this->ewalletCharge($data['id'], $id, $xenditIdPayment, $data['total'], $data['payment_method']);

            if (!isset($response_ewallet->json()['error_code'])) {
                $data->update([
                    'xendit_reference_id' => $response_ewallet->json()['id']
                ]);

                return $data['payment_method'] == 'ID_SHOPEEPAY' ? $response_ewallet->json()['actions']['mobile_deeplink_checkout_url'] : $response_ewallet->json()['actions']['desktop_web_checkout_url'];
            } else {
                dd($response_ewallet->json());
            }
        } else {
            dd($response_splits->json());
        }
    }

    public function singlePayment($data) {
        $xenditIdPayment = Umkm::where('id', $data['children'][0]['merchant_id'])->first();

        $response_ewallet = $this->ewalletCharge($data['id'], null, $xenditIdPayment, $data['total'], $data['payment_method']);

        if (!isset($response_ewallet->json()['error_code'])) {
            $id = $response_ewallet->json()['id'];
            $data->xendit_reference_id = $id;
            $data->save();

            return $data['payment_method'] === 'ID_SHOPEEPAY' ? $response_ewallet->json()['actions']['mobile_deeplink_checkout_url'] : $response_ewallet->json()['actions']['desktop_web_checkout_url'];
        } else {
            dd($response_ewallet->json());
        }

    }

    public function ewalletCharge($id, $splits_id, $xendit_user_id, $total, $payment_method) {
        return Http::withHeaders([
            'Authorization' => 'Basic '.base64_encode(config('services.xendit.secret_key').':'),
            'Content-Type' => 'application/json',
            'callback-url' => secure_url('/webhook/ewallet'),
            $splits_id ?? 'with-split-rule' => $splits_id,
            'for-user-id' => $xendit_user_id['xendit_user_id']
        ])->post('https://api.xendit.co/ewallets/charges', [
            'reference_id' => uniqid(rand()),
            'currency' => 'IDR',
            'amount' => (float) $total,
            'checkout_method' => 'ONE_TIME_PAYMENT',    
            'channel_code' => $payment_method,
            'channel_properties' => [
                'success_redirect_url' => secure_url('/payment/'.$id),
            ],
        ]);
    }

    public function splits_rule($data) {
        return Http::withHeaders([
            'Authorization' => 'Basic '.base64_encode(config('services.xendit.secret_key').':'),
            'Content-Type' => 'application/json'
        ])->post('https://api.xendit.co/split_rules', [
            'name' => 'order '.uniqid(),
            'description' => 'Split Payments',
            'routes' => $data
        ]);
    }
}
