<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserSoftdelete extends Migration {

    public function up() {
        
        Schema::table('users', function(Blueprint $table) {
            $table->softDeletes();	
        });
    }
}