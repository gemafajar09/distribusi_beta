<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPurchaseTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_purchase_tmp', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_purchase_tmp');
            $table->string('invoice_id',100);
            $table->date('invoice_date');
            $table->string('transaksi_tipe',100);
            $table->date('term_until');
            $table->integer('id_suplier');
            $table->integer('produk_id');
            $table->integer('quantity');
            $table->integer('unit_satuan_price');
            $table->integer('diskon');
            $table->integer('total_price');
            $table->integer('id_cabang');
            $table->integer('id_gudang');
            $table->char('status',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_purchase_tmp');
    }
}
