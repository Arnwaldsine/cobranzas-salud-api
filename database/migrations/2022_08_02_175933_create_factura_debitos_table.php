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
        Schema::create('debito_factura', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->unsignedBigInteger('nota_debito_id');
            $table->foreign('nota_debito_id')->references('id')->on('notas_debito');
            $table->decimal('subtotal',10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debito_factura');
    }
};
