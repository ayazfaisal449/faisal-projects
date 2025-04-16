<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyForStatusOnTrainerUpgradeStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trainer_upgrade_status', function(Blueprint $table)
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
		Schema::table('trainer_upgrade_status', function(Blueprint $table)
		{
			$table->dropForeign('trainer_upgrade_status_status_id_foreign');
		});
	}

}