<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsalestmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnsalestmps', function (Blueprint $table) {
            $table->bigIncrements('id_tmpreturn');
            $table->string('id_returnsales',100);
            $table->date('return_date');
            $table->string('id_stok',50);
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('diskon');
            $table->integer('id_user');
            $table->text('note')->nullabel();
            $table->integer('harga_satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returnsalestmps');
    }
}
