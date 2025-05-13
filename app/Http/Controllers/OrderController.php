<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;

class OrderController extends Controller
{
    public function orderUserPage() {
        $data = Order::with(['children', 'orderItems', 'merchants', 'orderItems.orderProducts'])->where([['user_id', '=' , session('user')['id']], ['parent_id', '!=', null]])->get();
        return view('order-list', ['orders' => $data]);
    }

    public function showUserOrder($id) {
        $data = Order::where('id', $id)->first();
        return view();
    }
}
