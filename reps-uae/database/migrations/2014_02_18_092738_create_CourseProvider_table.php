<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProviderTable extends Migration {

	/**
	 * Run the migrations.
	 * Create By Raj @ Craniumcreations
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_provider', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('name',225);
			$table->text('description');
			$table->string('logo',225);
			$table->string('website',225);
			$table->boolean('status')->default(1);
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
		Schema::drop('course_provider');
	}

}
