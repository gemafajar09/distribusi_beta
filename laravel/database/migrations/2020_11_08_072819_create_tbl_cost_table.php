<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cost', function (Blueprint $table) {
            $table->bigIncrements('cost_id');
            $table->integer('id_sales');
            $table->date('tanggal');
            $table->string('cost_nama');
            $table->integer('nominal');
            $table->integer('type');
            $table->string('inv_cost');
            $table->integer('id_cabang');
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
        Schema::dropIfExists('tbl_cost');
    }
}
