<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->string('product_id')->unique(); // Unique product ID
            $table->string('name'); // Product name
            $table->json('categories'); // Categories as JSON
            $table->string('sku'); // SKU (Stock Keeping Unit)
            $table->decimal('price', 10, 2); // Price with precision
            $table->integer('stock_quantity'); // Stock quantity
            $table->string('size')->nullable(); // Optional size
            $table->string('weight')->nullable(); // Optional weight
            $table->text('description'); // Product description
            $table->json('images'); // JSON for multiple images
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
