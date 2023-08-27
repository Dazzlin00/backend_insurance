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
        Schema::create('reclamo_polizas', function (Blueprint $table) {
           
            $table->unsignedBigInteger('id_reclamo');
            $table->unsignedBigInteger('id_poliza');
            $table->foreign('id_reclamo')->references('id')  ->on('reclamos');
            $table->foreign('id_poliza')->references('id')  ->on('polizas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamo_polizas');
    }
};
