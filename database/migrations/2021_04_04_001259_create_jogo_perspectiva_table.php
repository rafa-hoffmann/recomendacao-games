<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogoPerspectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogo_perspectiva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jogo_id');
            $table->unsignedBigInteger('perspectiva_id');
            $table->foreign('jogo_id')->references('id')->on('jogos')->onDelete('cascade');;
            $table->foreign('perspectiva_id')->references('id')->on('perspectivas')->onDelete('cascade');;
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
        Schema::dropIfExists('jogo_perspectiva');
    }
}
