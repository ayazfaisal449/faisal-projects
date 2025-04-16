<?php 
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

		 $user = Sentry::createUser(array(
			'email'     => 'admin@repsuae.com',
			'password'  => 'admin123',
            'first_name' => 'Admin',
            'last_name' => 'Reps',
			'activated' => true,
		));
        
        $groupAdmin = Sentry::findGroupByName('Admin');
        
        $user->addGroup($groupAdmin);
		
    }

}
?>