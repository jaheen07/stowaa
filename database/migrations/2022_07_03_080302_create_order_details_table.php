<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('user_name');
            $table->integer('product_id');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('quantity');
            $table->integer('total_price');
            
            $table->string('Email');
            $table->integer('phone');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('notes')->nullable();
            $table->string('grand_total');
            $table->integer('payment_method');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
