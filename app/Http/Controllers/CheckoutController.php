<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\XenditService;
use App\Services\OrderService;
use App\Models\CartItems;
use App\Models\Umkm;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\OrderSplits;
use App\Models\ProfileUser;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $arrayFilters = array_filter($request->check);
        session(['checkout_cart_id' => $arrayFilters]);
        
        return redirect('/checkout/page');
    }

    public function show() {
        $profileUser = ProfileUser::where('user_id', session('user')['id'])->first();
        $arrayFilters = session('checkout_cart_id');
        $umkms = Umkm::get();
        $cartItems = [];
        $umkmMap = [];
        $groupedData = [];

        $total = 0;

        foreach ($arrayFilters as $key => $value) {
            $item = CartItems::with(['product'])->where('id', $arrayFilters[$key])->first();
            $cartItems[] = $item;
            $total += $item->qty * $item->product->price;
        }

        foreach ($umkms as $umkm) {
            $umkmMap[$umkm['id']] = $umkm;
        }

        foreach ($cartItems as $item) {
            $umkmId = $item['product']['umkm']['id'];

            if (!isset($groupedData[$umkmId])) {
                $groupedData[$umkmId] = array(
                    'umkm' => $umkmMap[$umkmId] ?? ['id' => $umkmId, 'name' => 'Unknown Umkm'],
                    'items' => [],
                    'total' => $total
                );
            }
            $groupedData[$umkmId]['items'][] = $item;
        }

        return view('checkout', ['data' => $groupedData, 'user' => $profileUser, 'jsonUser' => json_encode($profileUser)]);
    }

    public function store(Request $request, OrderService $order) {
        $externalId = uniqid(rand());
        $link = $order->setOrder($request->splits, $request->payment);
        
        return redirect()->away($link);
    }

}
