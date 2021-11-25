<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('description');
            $table->string('adresse');
            $table->float('salaire');
            $table->date('date_creation');
            $table->string('image');
            $table->boolean('status')->nullable();
            $table->integer('rating');

            $table->bigInteger('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');

            //$table->bigInteger('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

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
        Schema::dropIfExists('emplois');
    }
}
