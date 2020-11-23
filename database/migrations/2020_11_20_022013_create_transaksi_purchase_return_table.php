<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPurchaseReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_purchase_return', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_purchase_return');
            $table->string('return_id');
            $table->date('return_date');
            $table->integer('id_suplier');
            $table->integer('stok_id');
            $table->char('note_return',1);
            $table->integer('jumlah_return');
            $table->integer('price');
            $table->char('register',1);
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
        Schema::dropIfExists('transaksi_purchase_return');
    }
}
