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
        Schema::create('poliza__usuarios', function (Blueprint $table) {
           
           $table->unsignedBigInteger('id_poliza');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_poliza')->references('id')->on('polizas');

            $table->foreign('id_usuario')->references('id')->on('users');

      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza__usuarios');
    }
};
