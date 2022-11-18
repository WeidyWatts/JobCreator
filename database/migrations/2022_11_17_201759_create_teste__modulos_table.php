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
        Schema::create('teste__modulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade')->onUpdate('cascade');;
            $table->unsignedBigInteger('teste_id');
            $table->foreign('teste_id')->references('id')->on('testes')->onDelete('cascade')->onUpdate('cascade');;

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
        Schema::dropIfExists('teste__modulos');
    }
};
