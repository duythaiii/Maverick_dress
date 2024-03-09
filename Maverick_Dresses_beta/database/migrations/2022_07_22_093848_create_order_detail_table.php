<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('order');

            $table->unsignedBigInteger('id_product_size');
            $table->foreign('id_product_size')->references('id')->on('product_size');

            $table->string('quantity');

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
        Schema::dropIfExists('order_detail');
    }
};
