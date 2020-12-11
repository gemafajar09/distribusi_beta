<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_produk', function (Blueprint $table) {
            $table->bigIncrements('produk_id');
            $table->integer('id_type_produk');
            $table->string('produk_brand');
            $table->string('produk_nama');
            $table->integer('produk_harga');
            $table->integer('stok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_produk');
    }
}
