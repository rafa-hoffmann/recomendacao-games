<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneroUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genero_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genero_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('relevancia')->default(0);
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
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
        Schema::dropIfExists('genero_user');
    }
}
