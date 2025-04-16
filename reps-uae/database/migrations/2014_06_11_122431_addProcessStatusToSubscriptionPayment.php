<?php
use Illuminate\Database\Migrations\Migration;

class AddProcessStatusToSubscriptionPayment extends Migration {

    public function up()
    {
        Schema::table('subscription_payment', function($table) {
            $table->integer('processStatus')->default(0);
        });
    }
}