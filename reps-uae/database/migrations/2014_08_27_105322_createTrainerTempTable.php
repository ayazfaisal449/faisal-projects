<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerTempTable extends Migration {

    public function up()
    {
        Schema::create('trainer_temp_table', function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('email', 225);
            $table->text('json_data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainer_temp_table');
    }
}