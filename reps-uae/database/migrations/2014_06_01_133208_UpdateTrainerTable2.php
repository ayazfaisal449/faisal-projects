<?php
use Illuminate\Database\Migrations\Migration;

class UpdateTrainerTable2 extends Migration {

    public function up() {
        Schema::table('trainer', function($table) {
            $table->string('reps_id')->nullable();
        });
    }
}