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
            $table->string('num_poliza');   //aqui no se puede usar el id de la tabla?
            $table->string('tipo_poliza');  //tipo poliza?
            
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento');
            $table->decimal('cobertura', 10, 2); //aqui no deberia estar el id de la cobertura?
            $table->decimal('monto_prima', 10, 2)->nullable();
            $table->string('estado')->default('Inactivo');
           
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
        Schema::dropIfExists('polizas');
    }
};
