<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true)->comment('true=activo, false=inactivo - Estado del articulo');
            $table->text('name')->comment('Nombre del articulo');
            $table->integer('quantity')->comment('Cantidad');
            $table->double('unit_value', 11, 2)->comment('Valor unitario');
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
        Schema::dropIfExists('items');
    }
}
