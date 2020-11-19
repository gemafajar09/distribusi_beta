<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_purchase', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_purchase');
            $table->string('invoice_id',100);
            $table->date('invoice_date');
            $table->string('transaksi_tipe',100);
            $table->date('term_until');
            $table->integer('id_suplier');
            $table->integer('produk_id');
            $table->integer('id_cabang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_purchase');
    }
}
