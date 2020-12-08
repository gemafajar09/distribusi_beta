<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnsales', function (Blueprint $table) {
            $table->string('id_returnsales',100);
            $table->date('return_date');
            $table->string('compensation',50);
            $table->date('date_term')->nullable();
            $table->string('id_sales',11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returnsales');
    }
}
