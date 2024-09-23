<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {

        if ($request->user() == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorize'
            ], 401);
        }

        $products = Product::where('stock', ">", 0)->where('is_publish', true)->get();
        return response()->json([
            'message' => 'Success to get all products',
            'products' => $products
        ]);
    }
    public function productDetail(Product $product)
    {

        return response()->json([
            'status' => 'success',
            'message' => 'success to get detail product',
            'product' => $product
        ]);
    }
}
