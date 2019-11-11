<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name', 128);
            $table->longText('content')->nullable();
            $table->string('image', 128);
            $table->string('thumb_image', 128)->nullable();
            $table->string('description', 128)->nullable();
            $table->integer('price');
            $table->integer('promotion_price')->nullable();
            $table->integer('price_M')->nullable();
            $table->integer('price_L')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
