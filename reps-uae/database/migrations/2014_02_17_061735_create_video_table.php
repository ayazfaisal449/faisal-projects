<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('video',function(Blueprint $table)
        {
            $table->bigIncrements('id')
                ->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')->on('video_category');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')
                ->references('id')->on('video_type');
            $table->boolean('is_active')->default(1);
            $table->string('code');
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
        Schema::dropIfExists('video');
	}

}
