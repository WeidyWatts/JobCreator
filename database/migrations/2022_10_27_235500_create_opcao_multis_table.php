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
        Schema::create('opcao_multis', function (Blueprint $table) {
            $table->id();
            $table->string('opcao');
            $table->boolean('is_correct');
            $table->unsignedBigInteger('questao_id');
            $table->foreign('questao_id')->references('id')->on('questao_multis')->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('opcao_multis');
    }
};
