<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_unit', function (Blueprint $table) {
            $table->bigIncrements('id_unit');
            $table->integer('produk_id');
            $table->integer('maximum_unit_name');
            $table->integer('minimum_unit_name');
            $table->integer('default_value');
            $table->string('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_unit');
    }
}
