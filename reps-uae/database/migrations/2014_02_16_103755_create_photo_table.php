<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('photo',function(Blueprint $table)
        {
            $table->bigIncrements('id')->unsigned();
            $table->string('filename');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')->on('photo_category');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('photo');
	}

}
