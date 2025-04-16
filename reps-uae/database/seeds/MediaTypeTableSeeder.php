<?php 
class MediaTypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('media_type')->delete();		
 		DB::table('media_type')->insert(
             array(
                     array(
							'type' =>'passport_copies'																																																	
                        ),
                        array(
                            'type' =>'photo'                                                                                                                                                                                                   
                        ),     
			));	
		
    }

}
?>