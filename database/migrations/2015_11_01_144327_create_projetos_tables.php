<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string('nome');
            $table->text('descricao');
            $table->smallInteger('progresso');
            $table->smallInteger('status');
            $table->date('due_date');
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
        Schema::drop('projetos');
    }
}
