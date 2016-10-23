<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetoFilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeto_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projeto_id')->unsigned();
            $table->foreign('projeto_id')->references('id')->on('projetos');
            $table->string('nome');
            $table->text('descricao');
            $table->string('extensao');
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
        Schema::drop('projeto_files');
    }
}
