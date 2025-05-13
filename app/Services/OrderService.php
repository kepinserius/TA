<?php

namespace App\Services;

use App\Services\XenditService;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\OrderSplits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class OrderService {

    public function setOrder($data ,$method) {
        $payment = new XenditService();
        DB::beginTransaction();

        try {
            
            $childOrder = [];
            $orderItems = [];
            $idChild = '';
            $total = 0;
            $totalChild = 0;
            $totalShipping = 0;
            $fee = 0;
            $vat = 0;

            foreach ($data as $key => $value) {
                $value_decode = json_decode($value['umkm']);
                $totalChild += $value['shipping_option'];
                $totalShipping += $value['shipping_option'];
                foreach ($value['items'] as $key => $item) {
                    $item_decode = json_decode($item);
                    $orderItems[] = array(
                        'order_id' => null,
                        'merchant_id' => $value_decode->id,
                        'product_id' => $item_decode->id,
                        'qty' => $item_decode->qty
                    );
                    $totalChild += ($item_decode->qty * $item_decode->price);
                }
                
                $childOrder[$value_decode->id] = array(
                    'parent_id' => null,
                    'merchant_id' => $value_decode->id,
                    'user_id' => session('user')['id'],
                    'address' => $value['address'],
                    'payment_method' => $method,
                    'total' => $totalChild,
                    'service_fee' => 1000.00,
                    'shipping_cost' => $value['shipping_option'],
                    'status' => $method == 'cod' ? 'process' : 'payment'
                );
                $total += $totalChild;
                $totalChild = 0;
            }

            $parentId = Order::create([
                'user_id' => session('user')['id'],
                'total' => $total,
                'service_fee' => $fee,
                'payment_method' => $method,
                'shipping_cost' => $totalShipping,
                'status' => $method == 'cod' ? 'process' : 'payment'
            ]);
            
            $idChild = $parentId->id;

            foreach ($childOrder as $merchant_id => $value) {
                $value['parent_id'] = $parentId->id;
                $childId = Order::create($value);
                $itemsForMerchant = array_filter($orderItems, function ($item) use ($merchant_id) {
                    return $item['merchant_id'] == $merchant_id;
                });

                foreach ($itemsForMerchant as $key => $item) {
                    $item['order_id'] = $childId->id;
                    OrderItems::create($item);
                }
            }
            
            
            DB::commit();

            if ($method = 'payment') {
                $orderData = Order::with(['children'])->where('id', $idChild)->first();
                if (count($orderData['children']) == 2) {
                    $link = $payment->doublePayment($orderData);
                    return $link;
                } else if (count($orderData['children']) > 2) {
                    return $payment->multiplePayments($orderData);
                } else {
                    return $payment->singlePayment($orderData);
                }
            }

        } catch (Throwable $th) {
            throw $th;
        }

    }

    public function setOrderItems() {

    }
}