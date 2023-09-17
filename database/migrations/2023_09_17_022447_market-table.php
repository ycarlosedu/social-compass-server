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
        Schema::create('marketplace_itens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario_id');
            $table->string('comprador_id')->nullable();
            $table->string('nome');
            $table->string('descricao', 500);
            $table->float('preco');
            $table->binary('imagem')->nullable();
            $table->boolean('vendido')->default(false);
            $table->timestamps();
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('comprador_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplace_itens');
    }
};
