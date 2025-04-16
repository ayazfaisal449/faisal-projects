<?php
namespace App\Http\Controllers;
class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Set up Cranium Mail Chimp
     * 
     * @return Mail Chimp obj
     * Created By Kevin @ Cranium Creations
     */
    public function mailChimp() 
    {
        return new CraniumMailChimp('fe3b5c6e046c17e6ed975582e9d3e5f1-us3');
    }

    /**
     * Setup the pagination for an array
     * @param $data (array), $dataPerPage (int)
     * @return pagination array
     * Created By Kevin @ Cranium Creations
     */
     public function paginator( $data, $dataPerPage, $appends=array() ) 
     {
        $paginator = Paginator::make($data, count($data), $dataPerPage);
       
        if(count($data) > $dataPerPage) {
             $data = array_slice($data,$paginator->firstItem()-1,$paginator->lastItem());
        }
        
        if(count($appends) > 0) 
        {
            return array('data'=>$data,'links'=>$paginator->appends($appends)->links());
        }
        else
        {
            return array('data'=>$data,'links'=>$paginator->appends(array())->links());
        }
     }
     
    /**
     * @param (var)
     * @returns slug
     * creates a slug
     * Created By Kevin @ Cranium Creations
     */
	public static function getSlug($text) 
    {
         $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
         $text = trim($text, '-');
         $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
         $text = strtolower($text);
         $text = preg_replace('~[^-\w]+~', '', $text);
         
         if (empty($text)) {
                return 'n-a';
         }
         
         return $text;
			 
	}
    
    /**
     * @param (array)
     * @return array
     * returns tmp file path in an array
     * Created By Kevin @ Cranium Creations
     */
    public function getTmpFiles($files,$user = NULL) 
    {
        $default = array();
        
        //check for number for files 
        $noFiles = count($files['name']);
        
        if($noFiles > 1 || is_array($files['name']))
        {
            for($i=0;$i<$noFiles;$i++)
            {
                $ext = strstr($files['name'][$i], '.');
                $default[] = array (
                    'name' => $this->getSlug(strstr($files['name'][$i], '.', $before_needle = true)).$ext,
                    'type' => $files['type'][$i],
                    'size' => $files['size'][$i],
                    'tmpNamePath' => $files['tmp_name'][$i]
                );
            }
        }
        else if( isset($files['name'][0]) && $files['name'][0] != '' )
        {
            $ext = strstr($files['name'], '.');
            $default[] = array (
                'name' => $this->getSlug(strstr($files['name'], '.', $before_needle = true)).$ext,
                'type' => $files['type'],
                'size' => $files['size'],
                'tmpNamePath' => $files['tmp_name']
            );
        }
        
        return $default;
    }
    
    /**
     * @param int
     * @return random string
     * Created By Kevin @ Cranium Creations
     */
    function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    
    /**
     * @param array files
     * @retrun bool
     * Created By Kevin @ Cranium Creations
     */
    function createTmpFiles($file,$fileType)
    {
        //check to see if random folder is set 
        $userDetails = Session::get('trainerDetails');
        
        if( !isset($userDetails['tmpFolder']) )
        {
            //generate a random string and make a folder
//            $folder = $this->generateRandomString(5);
            $folder = uniqid();
            $userDetails['tmpFolder'] = $folder;
            
            //save tmp folder in session
            Session::put('trainerDetails',$userDetails);
            
            //set tmp folder for users
            File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder,
                0755,true);
            
            //set sub-folders
            File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/photo',
                0755,true);

              File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/image',
                0755,true);

                File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/e_certificate',
                0755,true);
//            File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/passport',
//                0755,true);
            File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/certificate',
                0755,true);
            File::makeDirectory(Config::get('tmp.tmpPath').'/'.$folder.'/cv',
                0755,true);
            
        }

        switch($fileType)
        {
            case 'cv':
                //check if the tmp folder is set 
                if(is_dir(Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/cv'))
                {
                    if ($file) {
                        //create tmp file in tmp folder
                        for( $i=0; $i<count($file); $i++ )
                        {
                            $result = move_uploaded_file($file[$i]['tmpNamePath'],
                            Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/cv/'.$file[$i]['name']);
                        }
                    } else {
                        $result = true; //user did not upload a CV
                    }
                    
                    //checking if the tmp folder was set up correctly
                    if(!$result)
                    {
                        Session::flash('trainerRegistration', false);
                    }
                    return $result;
                   
                }
                else 
                {
                    return false;
                }
            break;
            
            case 'photo':
                //check if the tmp folder is set 
                if(is_dir(Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/photo'))
                {
                    
                    //create tmp file in tmp folder
                    for( $i=0; $i<count($file); $i++ )
                    {
                        $result = move_uploaded_file($file[$i]['tmpNamePath'],
                           Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/photo/'.$file[$i]['name']);
                        //dd($result);
                    }
                    
                    //checking if the tmp folder was set up correctly
                    if(!isset($result))
                    {
                        // dd('here');
                        Session::flash('trainerRegistration', false);
                    }
                    
                    return $result;
                    
                }
                else 
                {
                    return false;
                }
            break;


            case 'image':
                // check if the tmp folder is set
                if (is_dir(Config::get('tmp.tmpPath') . '/' . $userDetails['tmpFolder'] . '/image')) {
            
                    // initialize $result variable
                    $result = true;
            
                    // create tmp file in tmp folder
                    for ($i = 0; $i < count($file); $i++) {
                        $result = move_uploaded_file($file[$i]['tmpNamePath'],
                            Config::get('tmp.tmpPath') . '/' . $userDetails['tmpFolder'] . '/image/' . $file[$i]['name']);
                        // dd($result);
                    }
            
                    // checking if the tmp folder was set up correctly
                    if (!$result) {
                        Session::flash('trainerRegistration', false);
                    }
            
                    return $result;
            
                } else {
                    return false;
                }
                break;

            
            case 'certificate':
                //check if the tmp folder is set 
                if(is_dir(Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/certificate'))
                {
                    if(count($file) >= 1) 
                    {
                        //create tmp file in tmp folder
                        for( $i=0; $i<5; $i++ )
                        {
                            $result = move_uploaded_file($file['tmpNamePath'],
                               Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/certificate/'.$file['name']);
                        } 
                    }
                    return $result;
                }
                else 
                {
                   return false;
                }
            break;
            
            case 'passport':
                    //check if the tmp folder is set 
                    if(is_dir(Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/passport'))
                    {
                        //create tmp file in tmp folder
                        for( $i=0; $i<count($file); $i++ )
                        {
                            $result = move_uploaded_file($file[$i]['tmpNamePath'],
                               Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/passport/'.$file[$i]['name']);
                        }
                        
                        //checking if the tmp folder was set up correctly
                        if(!$result)
                        {
                            Session::flash('trainerRegistration', false);
                        }
                        return $result;
                       
                    }
                    else
                    {
                        return false;
                    }
            break;
        } 
    }
    
    /**
     * @param array $data
     * @return array
     * validate multiple Text box
     * Created By Kevin @ Cranium Creations
     */
    public function validateMulipleTextBox($data)
    {
        $count = 0;
        for( $i=0; $i < count($data); $i++ )
        {
            if (!isset($data[$i]) || $data[$i] == '')
            {
                continue;
            }
            $count++;
           
        }
        
        if ($count > 0)
        {
            $old = array(
                'status' => false,
                'data' => $data,
            );
        }
        else
        {
            $old = array(
                'status' => true,
                'data' => $data,
                'error' => 'Please fill in at least one Work Place'
            );
        }
        
        return $old;
    }
    
    /**
     * @param array text fields
     * @return array
     * validate multiple Text box for alphabets and spaces
     * Created By Kevin @ Cranium Creations
     */
    public function validateAlplaSpaces($data)
    {
        $flag = array();
//        for($i=0;$i<count($data);$i++)
//        {
//            if(isset($data[$i]) && trim($data[$i]) != '')
//            {
//                if(preg_match('/^[\pL\s]+$/u', $data[$i]))
//                {
//                    $flag['status'] = false;
//                }
//                else
//                {
//                    $flag['status'] = true;
//                    $flag['error'][$i] = 'Please only use alphabets and spaces';
//                }
//            }
//        }
        $flag['status'] = false;
        return $flag;
    }
    
    /**
     * validate user 
     * Created By Kevin @ Cranium Creations
     */
    public function validateUser($data)
    {
        $validator = Validator::make(
            array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'password' => isset($data['password'])?$data['password']:'',
                'email' => isset($data['email'])?$data['email']:'',
            ),
            array(
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users'
            )
        );
        
        if( $validator->fails() )
        {
            //check to see if there is a logged in user
            if( Sentry::check() )
            {
                $errors = $validator->messages()->getMessages();
                
                if(isset($errors['password']))
                    unset($errors['password']);
                if(isset($errors['email']))
                    unset($errors['email']);
                
                if(count($errors) > 0)
                {
                    return array(
                        'status' => true,
                        'messageBag' => $validator->messages()
                    );
                }
                else
                {
                    return array (
                        'status' => false
                    );
                }
            }
            else
            {
                return array(
                    'status' => true,
                    'messageBag' => $validator->messages()
                );
            }
            
        }
        else
        {
            return array (
                'status' => false
            );
        }
    }
}