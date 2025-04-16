<?php 
class StatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('status')->delete();
 		DB::table('status')->insert(
             array(
                     array(
							'name' =>'Provisional'																																																	
                        ),
                        array(
                            'type' =>'Full'                                                                                                                                                                                                   
                        ), 
                        array(
                            'type' =>'Not Allocated'                                                                                                                                                                                                   
                        ),                        
			));	
		
    }

}
?>