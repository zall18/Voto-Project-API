<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discounted_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('product_id');
            $table->decimal('real_price', 10, 2);
            $table->decimal('discount_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounted_products');
    }
};
