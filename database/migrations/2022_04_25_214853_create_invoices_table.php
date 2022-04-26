<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true)->comment('true=activo, false=inactivo - Estado de la factura');
            $table->text('number')->comment('Numero de factura');
            $table->double('value', 11, 2)->comment('Valor sin IVA');
            $table->enum('iva', ['1', '2', '3']);
            $table->double('total_value', 11, 2)->comment('Valor con iva');
            $table->unsignedBigInteger('transmitter_id')->comment('Id del emisor');
            $table->unsignedBigInteger('receiver_id')->comment('Id del receptor');
            $table->timestamps();

            $table->foreign('receiver_id')->references('id')->on('receivers');
            $table->foreign('transmitter_id')->references('id')->on('transmitters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
