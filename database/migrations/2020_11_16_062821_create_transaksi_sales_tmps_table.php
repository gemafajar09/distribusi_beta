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
            $table->string('unit1',25)->nullable();
            $table->string('unit2',25)->nullable();
            $table->string('unit3',25)->nullable();
            $table->double('diskon');
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('transaksi_sales_tmps');
    }
}
