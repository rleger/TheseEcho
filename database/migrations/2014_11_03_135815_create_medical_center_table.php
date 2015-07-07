<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalCenterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medical_center', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('token')->nullable();
            $table->string('email');
            $table->string('name');
            $table->string('country');
            $table->string('fonction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('medical_center');
    }
}
