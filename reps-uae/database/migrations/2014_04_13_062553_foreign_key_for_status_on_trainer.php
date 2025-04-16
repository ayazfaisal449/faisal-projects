<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyForStatusOnTrainer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trainer', function(Blueprint $table)
		{
			$table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trainer', function(Blueprint $table)
		{
			$table->dropForeign('trainer_status_id_foreign');
		});
	}

}