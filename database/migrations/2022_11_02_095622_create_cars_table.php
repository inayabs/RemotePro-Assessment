<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('color_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
