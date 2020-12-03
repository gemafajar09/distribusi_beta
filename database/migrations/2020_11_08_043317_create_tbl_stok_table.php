<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stok', function (Blueprint $table) {
            $table->bigIncrements('stok_id');
            $table->integer('id_suplier');
            $table->integer('produk_id');
            $table->integer('jumlah');
            $table->integer('capital_price');
            $table->integer('id_cabang');
            $table->integer('id_gudang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stok');
    }
}
