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
        Schema::create('usuario_conteudos', function (Blueprint $table) {
            $table->id();
            $table->string('conteudo_table'); // anexo, artigo, link, teste, video
            $table->unsignedBigInteger('conteudo_id'); //referencia a tabela de conteudo citada na colula acima.
            $table->unsignedBigInteger('ju_id'); // referencia a tabela Journey_Usuario
            $table->foreign('ju_id')->references('id')->on('journey__usuarios')->onDelete('cascade')->onUpdate('cascade');;
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('status'); // 0 - não iniciado, 1 - em andamento, 2 - concluido.
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
        Schema::dropIfExists('usuario_conteudos');
    }
};
