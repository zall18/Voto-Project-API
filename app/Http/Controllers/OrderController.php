<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'items' => ['required', 'array'],
        // ]);


        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'failed',
        //         'message' => 'failed to checkout',
        //         'data' => $validator->errors()
        //     ], 400);
        // }
        // if (count($request->items) == 0) {
        //     return 
        // } else {

        $auth = $request->user();
        $data = Cart::where("user_id", $auth->id)->get();
        $total = 0;
        foreach ($data as $item) {
            $total += $item->product->price * $item->quantity;
        }
        $items = $data;
        $total_price = $total;
        $address = Address::where('user_id', $auth->id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'success to get checkout data',
            'total_price' => $total_price,
            'address' => $address,
            'items' => $items,

        ]);
        // }
    }

    public function checkoutProcess(Request $request)
    {
        // $cart = json_decode($request->input('cart'), true);
        $auth = $request->user();
        $items = Cart::where("user_id", $auth->id)->get();

        $total = 0;
        foreach ($items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $saveOrder = Order::create([
            'user_id' => $auth->id,
            'total_price' => $total
        ]);
        $lastId = $saveOrder->id;

        foreach ($items as $item) {
            OrderItems::create([
                'order_id' => $lastId,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            $product = Product::where('id', $item->product->id)->first();
            $product->stock = $product->stock - $item->quantity;
            $product->save();
        }

        Cart::where('user_id', $auth->id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'success to checkout data',
            'status_items' => 'pending',
            'data' => $items
        ]);
    }

    public function GetAllOrder(Request $request)
    {
        $auth = $request->user();
        $data = Order::where('user_id', $auth->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'success to get all order',
            'orders' => $data
        ], 200);
    }

    public function GetOrderById(Request $request)
    {
        $auth = $request->user();
        $data = OrderItems::where('order_id', $request->id)->get();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'success to get order by id',
                'orders' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get order by id',
            ], 404);
        }

    }

}
