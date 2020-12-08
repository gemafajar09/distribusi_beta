<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsalesdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnsalesdetail', function (Blueprint $table) {
            $table->bigIncrements('id_detailreturn');
            $table->string('id_returnsales',100);
            $table->string('id_stok',50);
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('diskon');
            $table->integer('id_user');
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
        Schema::dropIfExists('returnsalesdetails');
    }
}
