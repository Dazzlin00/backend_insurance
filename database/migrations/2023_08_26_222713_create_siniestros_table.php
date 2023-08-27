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
            $table->string('numero_siniestro');
            $table->date('fecha_reporte');
            $table->string('descripcion');
            $table->string('estado');

            $table->foreign('id_tipo_siniestro')->references('id')  ->on('tipo_siniestros');

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
