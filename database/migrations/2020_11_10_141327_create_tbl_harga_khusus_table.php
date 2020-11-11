<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblHargaKhususTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_harga_khusus', function (Blueprint $table) {
            $table->bigIncrements('id_harga_khusus');
            $table->integer('id_customer');
            $table->integer('produk_id');
            $table->integer('spesial_nominal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_harga_khusus');
    }
}
