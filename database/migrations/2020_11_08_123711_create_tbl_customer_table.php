<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->bigIncrements('id_customer');
            $table->string('nama_customer');
            $table->string('nama_perusahaan');
            $table->integer('credit_plafond');
            $table->string('alamat');
            $table->string('negara');
            $table->string('kota');
            $table->string('telepon');
            $table->string('kartu_kredit');
            $table->string('fax');
            $table->integer('id_sales');
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
        Schema::dropIfExists('tbl_customer');
    }
}
