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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_poliza');
            $table->unsignedBigInteger('numero_transaccion');
            $table->decimal('monto', 10, 2)->default(0.00);
            $table->date('fecha_pago');
            $table->string('descripcion');
            $table->string('estado');
            $table->foreign('id_poliza')->references('id')->on('polizas');
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
        Schema::dropIfExists('pagos');
    }
};
