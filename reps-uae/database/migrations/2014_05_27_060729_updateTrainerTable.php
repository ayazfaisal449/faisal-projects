<?php
use Illuminate\Database\Migrations\Migration;

class UpdateTrainerTable extends Migration {

    public function up() {
        Schema::table('trainer', function($table) {
            $table->string('work_email')->nullable();
        });
    }
}