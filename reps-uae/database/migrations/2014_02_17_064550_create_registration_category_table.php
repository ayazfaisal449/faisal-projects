<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 * Create By Raj @ Craniumcreations
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_category', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('level');
            $table->timestamps();	
			$table->softDeletes();			
		});
        
        DB::table('registration_category')->delete();
        
        DB::table('registration_category')->insert(
      
            array(
                array(
                    'level' =>'1 (a) Assistant Instructor'
                ),
                array(
                    'level' =>'2 (a) Group Fitness Instructor'
                ),
                array(
                    'level' =>'2 (b) Group Fitness Instructor (Freestyle)'
                ),
                array(
                    'level' =>'2 (c) Gym Instructor'
                ),
                array(
                    'level' =>'2 (d) Aqua Fitness Instructor'
                ),
                array(
                    'level' =>'3 (a) Personal Trainer'
                ),
                array(
                    'level' =>'3 (b) Pilates Teacher'
                ),
                array(
                    'level' =>'3 (c) Yoga Teacher'
                ),
            )
            
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_category');
	}

}
