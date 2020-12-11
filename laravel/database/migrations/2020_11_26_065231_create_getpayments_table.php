<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_getpayment', function (Blueprint $table) {
            $table->bigIncrements('id_getpayment');
            $table->string('payment_id',100);
            $table->string('invoice_id',100);
            $table->date('tgl_payment');
            $table->integer('payment');
            $table->string('status',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('getpayments');
    }
}
