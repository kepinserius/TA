<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentsController extends Controller
{
    public function paymentPage($id) {
        $data = Order::where('id', $id)->first();
        return view('payment-status', ['payment' => $data]);
    }

    public function checkPayment($id) {
        $data = Order::where('id', $id)->first();
        return response()->json($data);
    }
}
