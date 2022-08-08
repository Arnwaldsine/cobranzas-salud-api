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
        Schema::create('gestiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obra_social_id');
            $table->foreign('obra_social_id')->references('id')->on('obras_sociales');
            $table->unsignedBigInteger('contacto_id');
            $table->foreign('contacto_id')->references('id')->on('contactos');
            $table->date('fecha_contacto');
            $table->unsignedBigInteger('respuesta_id');
            $table->foreign('respuesta_id')->references('id')->on('respuestas');
            $table->date('fecha_proximo_contacto');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('observaciones');
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
        Schema::dropIfExists('gestiones');
    }
};
