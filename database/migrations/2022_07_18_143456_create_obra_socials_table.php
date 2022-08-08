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
        Schema::create('obras_sociales', function (Blueprint $table) {
            $table->id();
            $table->string('rnos',8);
            $table->string('nombre')->nullable(false);
            $table->string('cuit',13)->nullable(false);
            $table->string('telefono',150);
            $table->string('direccion',200);
            $table->string('cp',50);
            $table->string('pagina',150);
            $table->string('horario_admin',100);
            $table->string('contacto_admin',100);
            $table->string('tel_admin',100);
            $table->string('contacto_geren_1',100);
            $table->string('contacto_geren_2',100);
            $table->string('tel_gere');
            $table->string('mail_geren');
            $table->string('observaciones');
            $table->unsignedBigInteger('tipo_prestador_id');
            $table->foreign('tipo_prestador_id')->references('id')->on('tipos_prestadores');
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
        Schema::dropIfExists('obras_sociales');
    }
};
