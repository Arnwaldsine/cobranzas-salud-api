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
        Schema::create('factura_recibo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('recibo_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('forma_pago_id');
            $table->foreign('forma_pago_id')->references('id')->on('formas_pago');
            $table->string('nro_cheque_transf');
            $table->string('nro_recibo_tesoreria');
            $table->unsignedBigInteger('banco_id');
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->decimal('subtotal',10,2)->nullable(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_recibo');
    }
};
