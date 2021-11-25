<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirmPassword');
            $table->enum('role', ['freelance', 'donneur', 'esn']);
            $table->string('adresse');
            $table->string('image');

            //$table->bigInteger('emplois_id')->unsigned()->nullable();
            //$table->foreign('emplois_id')->references('id')->on('emplois')->onDelete('cascade');

            $table->bigInteger('mission_id')->unsigned()->nullable();
            $table->foreign('mission_id')->references('id')->on('mission')->onDelete('cascade');

            $table->bigInteger('article_id')->unsigned()->nullable();
            $table->foreign('article_id')->references('id')->on('article')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
