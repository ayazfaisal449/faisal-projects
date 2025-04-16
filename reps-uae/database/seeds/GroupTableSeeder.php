<?php 
class GroupTableSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

		 $groupTrainer = Sentry::createGroup(array(
            'name' => 'Trainer',
            'permissions' => array(
                'trainer.update' => 1,
                'trainer.payment' => 1,
                'trainer.dashboard' => 1,
            ),
        ));
        
        $groupAdmin = Sentry::createGroup(array(
            'name' => 'Admin',
            'permissions' => array(
                'trainer.update' => 1,
                'trainer.payment' => 1,
                'admin.update' => 1,
                'admin.add' => 1,
                'admin.dashboard' => 1,
            ),
        ));
		
    }

}
?>