<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class WebhookController extends Controller
{
    public function handleEwallet(Request $request) {
        $data = $request->all();
        
        $parentOrder = Order::where('xendit_reference_id', $data['data']['id'])->first();
        $childOrder = Order::where('parent_id', $parentOrder['id'])->get();
        $parentOrder->status = 'pending';
        $parentOrder->save();

        foreach ($childOrder as $key => $value) {
            Order::where('id', $value->id)->update([
                'status' => 'pending'
            ]);
        }
        
        return response()->json(['message' => 'Webhook received']);
    }

    public function handleDisbursement(Request $request) {

        $signatureKey = $request->header('x-callback-token');
        if ($signatureKey !== env('XENDIT_WEBHOOK_SECRET')) {
            return response()->json(['message' => $signatureKey], 401);
        }

        $data = $request->all();

        $parentOrder = Order::where('reference_id', $data->id)->first();
        $parentOrder->status = 'process';
        $parentOrder->save();
        
        return response()->json(['message' => 'Webhook received']);
    }

}
