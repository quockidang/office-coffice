<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('sitetitle', 128)->nullable();
            $table->string('metakeywords', 158)->nullable();
            $table->string('metadescription', 128)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('sortorder')->nullable();
            $table->integer('visibility')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
