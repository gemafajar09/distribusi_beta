<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOpnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_opname', function (Blueprint $table) {
            $table->bigIncrements('id_opname');
            $table->integer('stok_id');
            $table->integer('jumlah_fisik');
            $table->char('balance',0);
            $table->date('update_opname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_opname');
    }
}
