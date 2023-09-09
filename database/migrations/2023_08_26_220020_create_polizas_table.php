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
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->string('num_poliza');

            $table->unsignedBigInteger('tipo_poliza'); 
            
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->unsignedBigInteger('cobertura'); 
            $table->decimal('monto_prima', 10, 2)->nullable();
            $table->string('estado')->default('Inactivo');
           
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('tipo_poliza')->references('id')->on('tipo_polizas');
            $table->foreign('cobertura')->references('id')->on('coberturas');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polizas');
    }
};
