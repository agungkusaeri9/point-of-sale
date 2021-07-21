<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store()
    {
        request()->validate([
            'item_id' => ['required']
        ]);

        $item = Item::findOrFail(request('item_id'));

        $price_total = request('qty') * $item->price;

        $cart = new Cart();
        $cart->item_id = request('item_id');
        $cart->qty = request('qty');
        $cart->price = $item->price;
        $cart->price_total = $price_total;
        $cart->user_id = auth()->id();
        $cart->save();

        return redirect()->back();

    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }

    public function deleteAll()
    {
        Cart::where('user_id', auth()->id())->delete();
        
        return redirect()->back();
    }
}
