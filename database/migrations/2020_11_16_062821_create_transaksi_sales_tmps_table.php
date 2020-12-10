<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiSalesTmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_sales_tmps', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_tmp');
            $table->string('invoice_id',100);
            $table->date('invoice_date');
            $table->integer('stok_id');
            $table->integer('price');
            $table->integer('quantity')->nullable();
            $table->integer('diskon');
            $table->integer('id_user')->nullable();
            $table->integer('harga_satuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_sales_tmps');
    }
}
