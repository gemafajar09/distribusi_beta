<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSuplierTable extends Migration
{
    /**
     * Run the migrations.
     *id_suplier
nama_suplier
nama_perusahaan
alamat
kota
negara
telepon
fax
bank
no_akun
nama_akun
note
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_suplier', function (Blueprint $table) {
            $table->bigIncrements('id_suplier');
            $table->string('nama_suplier');
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->string('kota');
            $table->string('negara');
            $table->string('telepon');
            $table->string('fax');
            $table->string('bank');
            $table->string('no_akun');
            $table->string('nama_akun');
            $table->text('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_suplier');
    }
}
