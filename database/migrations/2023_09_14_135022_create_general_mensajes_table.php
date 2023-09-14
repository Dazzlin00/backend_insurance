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
        Schema::create('general_mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('contenido');
            $table->string('estado');
            $table->unsignedBigInteger('id_agente')->nullable();
            $table->timestamps();

            $table->foreign('id_agente')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_mensajes');
    }
};
