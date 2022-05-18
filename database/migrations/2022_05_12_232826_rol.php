<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rol', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol');
            $table->timestamps();
        });
        DB::table("rol")
            ->insert([
                "rol" => "admin"
            ]);
            DB::table("rol")
            ->insert([
                "rol" => "veterinario"
            ]);
            DB::table("rol")
            ->insert([
                "rol" => "asistente"
            ]);
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
