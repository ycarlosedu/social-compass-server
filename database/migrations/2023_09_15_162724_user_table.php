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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('id', 36)->unique()->index();
            $table->string('nome');
            $table->string('usuario');
            $table->string('data_nascimento');
            $table->string('email');
            $table->string('password');
            $table->string('sexo')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
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
        Schema::dropIfExists('usuarios');
    }
};
