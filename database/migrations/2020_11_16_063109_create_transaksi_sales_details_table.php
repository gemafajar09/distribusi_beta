<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_sales_details', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_detail');
            $table->string('invoice_id',100);
            $table->date('invoice_date');
            $table->integer('stok_id');
            $table->integer('qty_carton');
            $table->integer('qty_cup');
            $table->integer('qty_pcs');
            $table->integer('qty_bungkus');
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
        Schema::dropIfExists('transaksi_sales_details');
    }
}
