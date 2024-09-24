<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('email');
            $table->text('address');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('country');
            $table->string('phone_number');
            $table->decimal('price', 10, 2);
            $table->string('order_id')->unique(); // 10-digit alphanumeric
            $table->enum('payment_type', ['cod', 'online']);
            $table->string('coupon_used')->nullable(); // Nullable for no coupon
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
