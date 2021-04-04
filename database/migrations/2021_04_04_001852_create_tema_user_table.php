<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('relevancia')->default(0);
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('cascade');;
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
        Schema::dropIfExists('tema_user');
    }
}
