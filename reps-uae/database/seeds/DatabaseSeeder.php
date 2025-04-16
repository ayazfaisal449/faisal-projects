<?php

class DatabaseSeeder extends Seeder {

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $this->call('GroupTableSeeder');
        $this->call('UserTableSeeder');	
        $this->call('NationalityTableSeeder');	
        $this->call('MediaTypeTableSeeder'); 
        $this->call('StatusTableSeeder');
        $this->command->info('Tables Seeded');
    }

}