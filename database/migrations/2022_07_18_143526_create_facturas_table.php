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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obra_social_id');
            $table->foreign('obra_social_id')->references('id')->on('obras_sociales');
            $table->timestamps();
            $table->unsignedBigInteger('punto_venta_id');
            $table->foreign('punto_venta_id')->references('id')->on('puntos_venta');
            $table->date('fecha_emision');
            $table->date('fecha_ultimo_pago')->nullable(true);
            $table->date('fecha_acuse');
            $table->decimal('importe',10,2)->nullable(false);
            $table->decimal('cobrado',10,2);
            $table->decimal('debe',10,2)->storedAs('importe - cobrado');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('observaciones');
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
        Schema::dropIfExists('facturas');
    }
};
