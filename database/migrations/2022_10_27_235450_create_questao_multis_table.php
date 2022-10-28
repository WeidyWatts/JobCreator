<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questao_multis', function (Blueprint $table) {
            $table->id();
            $table->string('enunciado');
            $table->boolean('multi_correct');
            $table->unsignedBigInteger('teste_id');
            $table->foreign('teste_id')->references('id')->on('testes');
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
        Schema::dropIfExists('questao_multis');
    }
};
