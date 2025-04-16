<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('video_category',function(Blueprint $table)
        {
            $table->bigIncrements('id')
                ->unsigned();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        
        DB::table('video_category')->delete();
        
        DB::table('video_category')->insert(
      
            array(
                array(
                    'name' =>'Default Category',
                    'description' =>'This is a default category',
                    'is_active' =>1,
                )	 
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
        Schema::dropIfExists('video_category');
	}
}
