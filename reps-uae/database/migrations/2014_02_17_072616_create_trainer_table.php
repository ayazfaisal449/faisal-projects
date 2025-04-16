<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerTable extends Migration {

	/**
	 * Run the migrations.
	 * Create By Raj @ Craniumcreations
	 * Modefied By jahir @ Craniumcreations
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainer', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('nationality_id')->unsigned();
			$table->foreign('nationality_id')->references('id')->on('nationality');
			$table->date('dob');
			$table->integer('gender');
			$table->string('city',255);
			$table->bigInteger('mobile_phone');
			$table->string('emirates_id_no');
			$table->string('passport_no');
            $table->string('photo',255);
            $table->date('expiry_date');
			$table->timestamps();	
			$table->softDeletes();	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('trainer');
	}

}