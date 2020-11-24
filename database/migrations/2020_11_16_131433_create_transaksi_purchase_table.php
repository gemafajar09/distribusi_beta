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
            $table->char('transaksi_tipe',2);
            $table->integer('id_suplier');
            $table->integer('total');
            $table->integer('diskon');
            $table->integer('bayar');
            $table->integer('sisa');
            $table->char('status',1);
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
