<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'james smith',
            'email' => 'james@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'admin'
        ]);

        Address::create([
            'user_id' => '1',
            'street_address' => 'Tokyo street ST 12',
            'city' => 'Tokyo',
            'state' => 'babakan muncang',
            'postal_code' => '09182',
            'country' => 'Japan',
            'phone' => '099809129803',
            'detail_address' => 'side of paradise'
        ]);

        // Product::create([
        //     'name' => 'discount product',
        //     'description' => 'description',
        //     'price' => 200000,
        //     'stock' => 100,
        //     'brand' => 'stark',
        //     'model' => 'old',
        //     'image' => 'canoneosr5-removebg-preview.png',
        //     'is_publish' => true,
        //     'is_discount' => true,
        //     'category_id' => 1,
        //     'user_id' => 1,
        // ]);

        // discountedProduct::create([
        //     'product_id' => $DiscountProduct,
        //     'real_price' => 200000,
        //     'discout_price' => 160000
        // ]);

        // Product::where('id', 1)->update([
        //     'price' => 160000
        // ]);

        User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(10)->create();
        Order::factory(10)->create();
        OrderItems::factory(10)->create();
        Cart::factory(10)->create();
        Address::factory(10)->create();
    }
}
