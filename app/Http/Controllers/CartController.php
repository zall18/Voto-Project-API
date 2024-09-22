<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getAllCart(Request $request)
    {
        $auth = $request->user();
        $carts = Cart::where('user_id', $auth->id)->get();
        return response()->json([
            'message' => 'Success to get all carts',
            'carts' => $carts
        ]);

    }

    public function addCartData(Request $request)
    {
        $auth = $request->user();
        $cart = Cart::where('user_id', $auth->id)
            ->where('product_id', $request->id)
            ->first();


        if ($cart) {
            return response()->json([
                'status' => 'failed',
                'message' => 'This product is already in cart',
                'data' => null
            ], 403);
        } else {
            $cart = Cart::create([
                'user_id' => $auth->id,
                'product_id' => $request->id,
                'quantity' => $request->quantity
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'success add item to cart',
                'data' => $cart
            ], 201);
        }


    }
}
