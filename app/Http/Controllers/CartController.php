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

    public function updateQty(Request $request, $id) {
        if ($request->qty == 0) {
            CartItems::where('id', $id)->delete();
        }
        return CartItems::where('id', $id)->update([
            'qty' => $request->qty
        ])
        ? response()->json($this->authCart())
        : response()->json('error');
    }

    public function authCart() {
        $data = Cart::with(['items', 'items.product'])->where([['user_id', '=' , session('user')['id']], ['status', '=', true]])->first();
        $total = 0;
        if (!$data) {
            Cart::insert([
                'user_id' => session('user')['id'],
            ]);
            $cart = Cart::with(['items', 'items.product'])->where([['user_id', '=' , session('user')['id']], ['status', '=', true]])->first();
            return $cart;
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
        return $cart;
    }

    public function destroy($id) {
        return CartItem::where('id', $id)->delete()
        ? redirect('/cart')->with('success', 'Berhasil menghapus data')
        : redirect()->back()->with('error', 'Gagal menghapus data');
    }
}
