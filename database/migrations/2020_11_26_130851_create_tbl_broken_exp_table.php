<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBrokenExpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_broken_exp', function (Blueprint $table) {
            $table->bigIncrements('id_broken_exp');
            $table->string('inv_broken_exp');
            $table->integer('id_gudang_dari');
            $table->integer('id_gudang_tujuan');
            $table->integer('stok_id');
            $table->integer('jumlah_broken');
            $table->date('movement_date');
            $table->string('note');
            $table->integer('id_cabang');
            $table->char('status_broken',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_broken_exp');
    }
}
