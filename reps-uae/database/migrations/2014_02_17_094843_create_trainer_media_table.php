<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerMediaTable extends Migration {

	/**
	 * Run the migrations.
	 * Create By Raj @ Craniumcreations
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainer_media', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('trainer_id')->unsigned();
			$table->foreign('trainer_id')->references('id')->on('trainer')->onDelete('cascade');
			$table->integer('media_type_id')->unsigned();
			$table->foreign('media_type_id')->references('id')->on('media_type')->onDelete('cascade');
			$table->string('media_filename',225);
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
		Schema::drop('trainer_media');
	}

}
