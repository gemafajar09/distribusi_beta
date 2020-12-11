<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cabang', function (Blueprint $table) {
            $table->bigIncrements('id_cabang');
            $table->string('nama_cabang');
            $table->string('alamat');
            $table->string('kode_cabang');
            $table->string('telepon');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cabang');
    }
}
