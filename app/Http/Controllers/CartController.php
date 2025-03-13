<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $authCart = $this->authCart();
        return view('cart', ['data' => $authCart]);
    }

    public function authCart() {
        $total = 0;
        $data = Cart::with(['items', 'items.product'])->where([['user_id', '=' , session('user')['id']], ['status', '=', 'false']])->first();
        if (!$data) {
            return Cart::insert([
                'user_id' => session('user')['id'],
            ]);
        }

        if (count($data->items) > 0) {
            foreach ($data->items as $item) {
                $total += $item->qty * $item->product->price;
            }
        }

        $data->update([
            'total' => $total,
        ]);
        
        return $data;
    }

    public function store(Request $request) {
        $cart = $this->authCart();

        $existItem = CartItems::where([
            'cart_id' => $cart['id'],
            'product_id' => $request->id
        ])->first();

        if (!$existItem) {
            return CartItems::insert([
                'cart_id' => $cart['id'],
                'product_id' => $request->id,
                'qty' => 1
            ])
            ? redirect('/cart')
            : redirect()->back()->with('error', 'Gagal menambahkan barang ke dalam keranjang');
        }

        $existItem->qty = $existItem->qty + 1;
        $existItem->save();
        return redirect('/cart');
    }
}
