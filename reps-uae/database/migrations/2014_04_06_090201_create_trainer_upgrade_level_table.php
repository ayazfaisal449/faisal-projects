<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerUpgradeLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainer_upgrade_level',function(Blueprint $table)
        {
            $table->bigIncrements('id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->foreign('trainer_id')
                ->references('id')->on('trainer');
            $table->string('course_name');
            $table->string('course_provider');
            $table->date('date_completed');
            $table->string('certificate');
            $table->string('category');
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
		Schema::dropIfExists('trainer_upgrade_level');
	}

}
