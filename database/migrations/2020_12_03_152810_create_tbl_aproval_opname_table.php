<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAprovalOpnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_aproval_opname', function (Blueprint $table) {
            $table->bigIncrements('id_aproval_opname');
            $table->integer('id_opname');
            $table->integer('stok_id');
            $table->integer('jumlah_fisik');
            $table->date('date_adjust');
            $table->char('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_aproval_opname');
    }
}
