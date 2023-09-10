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
        Schema::create('siniestros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_siniestro');
            $table->unsignedBigInteger('id_poliza');
            $table->unsignedBigInteger('id_usuario');

            $table->date('fecha_reporte');
            $table->date('fecha_declaracion');
            $table->string('estado_ocu');
            $table->string('ciudad');
            $table->string('lugar');
            $table->string('descripcion');
            $table->string('estado');

            $table->foreign('id_tipo_siniestro')->references('id')  ->on('tipo_siniestros');
            $table->foreign('id_poliza')->references('id')  ->on('polizas');
            $table->foreign('id_usuario')->references('id')  ->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siniestros');
    }
};
