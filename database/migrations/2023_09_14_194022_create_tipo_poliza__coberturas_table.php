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
        Schema::create('tipo_poliza__coberturas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tipo_poliza');
            $table->unsignedBigInteger('id_cobertura');
            $table->foreign('id_tipo_poliza')->references('id')->on('tipo_polizas');

            $table->foreign('id_cobertura')->references('id')->on('coberturas');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_poliza__coberturas');
    }
};
