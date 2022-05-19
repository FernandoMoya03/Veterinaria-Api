<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistorialClinico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_clinico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('diagnostico',45);
            $table->string('fecha',45);
            $table->unsignedBigInteger('cita');
            $table->foreign('cita')->references('id')->on('citas');
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
        //
    }
}
