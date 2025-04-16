<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration {

	/**
	 * Run the migrations.
	 * Create By Raj @ Craniumcreations
	 * @return void
	 */
	public function up()
	{
		Schema::create('course', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('course_provider_id')->unsigned();
			$table->foreign('course_provider_id')->references('id')->on('course_provider')->onDelete('cascade');
            $table->integer('registration_category_id')->unsigned();
			$table->foreign('registration_category_id')->references('id')->on('registration_category')->onDelete('cascade');
			$table->integer('course_type');
			$table->string('name',225);
			$table->text('description');
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
		Schema::drop('course');
	}

}
