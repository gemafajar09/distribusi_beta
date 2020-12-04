<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_sales', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi_sales');
            $table->string('sales_type',50);
            $table->string('invoice_id',100);
            $table->date('invoice_date');
            $table->string('transaksi_tipe',100);
            $table->date('term_until');
            $table->integer('sales_id')->nullable();
            $table->integer('customer_id');
            $table->text('note')->nullable();
            $table->integer('totalsales')->nullable();
            $table->double('diskon')->nullable();
            $table->integer('id_user');
            $table->integer('id_warehouse');
            $table->string('status',20)->nullable();
            $table->integer('approve')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_sales');
    }
}
