<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name','255');	
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
		Schema::dropIfExists('status');
	}

}
