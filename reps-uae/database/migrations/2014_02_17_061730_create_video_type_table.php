<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('video_type',function(Blueprint $table)
        {
            $table->bigIncrements('id')
                ->unsigned();
            $table->string('name');
            $table->text('html_code');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('video_type')->insert(array(
            array(
                'name' => 'Youtube',
                'html_code' => '<iframe width="%d" height="%d" src="//www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>',
            ),
            array(
                'name' => 'Vimeo',
                'html_code' => '<iframe width="%d" height="%d" src="//player.vimeo.com/video/%s?badge=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
            ),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('video_type');
	}

}
