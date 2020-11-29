<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBrokenExpDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_broken_exp_details', function (Blueprint $table) {
            $table->bigIncrements('id_broken_exp_details');
            $table->integer('inv_broken_exp');
            $table->integer('stok_id');
            $table->integer('produk_id');
            $table->integer('unit_1');
            $table->integer('unit_2');
            $table->integer('unit_3');
            $table->integer('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_broken_exp_details');
    }
}
