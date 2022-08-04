<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Citas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mascota');
            $table->foreign('mascota')->references('id')->on('mascotas');
            $table->unsignedBigInteger('cliente');
            $table->foreign('cliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('servicio');
            $table->foreign('servicio')->references('id')->on('servicios');
            $table->unsignedBigInteger('veterinario');
            $table->foreign('veterinario')->references('id')->on('users');
            $table->date('fecha',45);
            $table->double('status',1);
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
