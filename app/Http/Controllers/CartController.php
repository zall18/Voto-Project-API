<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Validator;

class CartController extends Controller
{
    public function getAllCart(Request $request)
    {
        $auth = $request->user();
        $carts = Cart::where('user_id', $auth->id)->get();
        $count = $carts->count();
        return response()->json([
            'message' => 'Success to get all carts',
            'carts_count' => $count,
            'carts' => $carts
        ]);

    }

    public function addCartData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to add cart data',
                'data' => $validator->errors()
            ], 400);
        }

        $auth = $request->user();
        $cart = Cart::where('user_id', $auth->id)
            ->where('product_id', $request->product_id)->first();
        // ->first();


        if ($cart) {
            return response()->json([
                'status' => 'failed',
                'message' => 'This product is already in cart',
                'data' => null
            ], 403);
        } else {
            $cartQuery = Cart::create([
                'user_id' => $auth->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'success add item to cart',
                'data' => $cartQuery
            ], 201);
        }
    }

    public function remove(Request $request)
    {
        $cart = Cart::find($request->product_id);

        if ($cart) {
            $deleteQuery = $cart->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'success to remove data from your cart',
                'data' => $deleteQuery
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to id data from your cart',
            ], 404);
        }


    }
}
