<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailInsuranceColumnTrainerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trainer', function (Blueprint $table) {
			$table->integer('avail_insurance')->default(0);
			$table->integer('disease')->default(0);
			$table->integer('criminal')->default(0);
			$table->integer('negligence')->default(0);
			$table->integer('insurer')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trainer', function (Blueprint $table) {
			$table->dropColumn('avail_insurance');
			$table->dropColumn('disease');
			$table->dropColumn('criminal');
			$table->dropColumn('negligence');
			$table->dropColumn('insurer');
		});
	}

}
