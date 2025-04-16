<?php
use Illuminate\Database\Migrations\Migration;

class UpdateIncrementCountRepsId extends Migration {

    public function up() {
        $statement = "ALTER TABLE repsIds AUTO_INCREMENT = 400;";
        DB::unprepared($statement);
    }

    public function down() {}
}