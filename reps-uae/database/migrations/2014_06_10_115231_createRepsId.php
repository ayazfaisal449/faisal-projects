<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepsId extends Migration {

    public function up() {
        Schema::create('repsIds', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->integer('user_id');	
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('repsIds');
    }
}