<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_center_id')->unsigned()->index();
            $table->foreign('medical_center_id')->references('id')->on('medical_center')->onUpdate('cascade')->onDelete('cascade');

            $table->string('client_ip_address')->nullable();

            // 1
            $table->string('email')->nullable();
            $table->string('sexe')->nullable();
            $table->string('pays_exercice')->nullable();
            $table->string('mode_exercice')->nullable();
            $table->string('distance_hopital')->nullable();

            // 2
            $table->string('interet_echo')->nullable();
            $table->string('interet_echo_oui')->nullable();
            $table->string('interet_echo_non')->nullable();

            // 3
            $table->string('indications')->nullable();
            $table->string('temps_formation')->nullable();
            $table->string('difficulte')->nullable();
            $table->string('utilisation')->nullable();
            $table->string('conclusion')->nullable();

            $table->boolean('subscribeToResult');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
