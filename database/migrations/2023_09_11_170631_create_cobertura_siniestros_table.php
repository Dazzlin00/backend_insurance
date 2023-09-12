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
        Schema::create('cobertura_siniestros', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cobertura');
            $table->unsignedBigInteger('id_tipo_siniestro');
            $table->foreign('id_cobertura')->references('id')->on('coberturas');

            $table->foreign('id_tipo_siniestro')->references('id')->on('tipo_siniestros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobertura_siniestros');
    }
};
