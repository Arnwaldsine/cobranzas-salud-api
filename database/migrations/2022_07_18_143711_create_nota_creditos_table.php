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
        Schema::create('notas_credito', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision');
            $table->decimal('total',10,2);
            $table->string('observaciones');
            $table->unsignedBigInteger('punto_venta_id');
            $table->foreign('punto_venta_id')->references('id')->on('puntos_venta');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_credito');
    }
};
