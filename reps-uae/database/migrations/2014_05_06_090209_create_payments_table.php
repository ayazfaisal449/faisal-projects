<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

    public function up()
    {
        Schema::create('subscription_payment', function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->foreign('trainer_id')->references('id')->on('trainer');
            $table->integer('invoice_id');
            $table->text('email');
            $table->text('details');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_payment');
    }
}