<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTraceTable extends Migration {

    public function up()
    {
        Schema::create('payment_trace', function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_trace');
    }
}