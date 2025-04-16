<?php
namespace App\Http\Controllers;
require_once base_path('vendor/2checkout/2checkout-php/lib/Twocheckout.php');
use Carbon\Carbon;
use Cranium\Country\Models\Country;

use Cranium\Slider\Models\Slider;
use Cranium\FacilitySlider\Models\FacilitySlider;
use Cranium\Partner\Models\Partner;
use Cranium\Benefit\Models\Benefit;
use Cranium\Jobs\Models\Jobs;
use Cranium\FAQ\Models\FAQ;
use Cranium\Footer\Models\Footer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use DB as DBS;


class PrimaryController extends BaseController {
    
    /*
     * home page
     * Created By Kevin @ Cranium Creations
     */
    public function index ()   
    {
       
        $data['slider']= Slider::orderBy('sort_order', 'asc')->get();  
        $data['facility_slider']= FacilitySlider::orderBy('sort_order', 'asc')->get(); 
        //$data1 = DBS::table('setting')->get(); 
        $data['setting'] = DBS::table('setting')->get();
        $data['registration_category']= DBS::table('registration_category')->orderBy('level', 'asc')->get(); 
        return View::make('primary.index',$data);
    }

    /**
     * Show the about page.
     *
     * @author Chris @ Cranium Creations
     */
    public function about()
    {
         $data['about'] =  DBS::table('footer')->where('pages','About Reps')->get();
         //dd( $data['about']);
         $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.about',$data);
        
    }
    /*
     * home page
     * Created By Kevin @ Cranium Creations
     */
    public function home () 
    {
        return View::make('primary.home');
    }
    
    
    /*
     * benefits page
     * Created By Kevin @ Cranium Creations
     */
    public function benefits () 
    {
        $data['setting'] = DBS::table('setting')->get();
        $data['benefits']= Benefit::orderBy('sort_order', 'asc')->get(); 
        return View::make('primary.benefits', $data);
    }
	
	public function jobs() 
    {
        $data['setting'] = DBS::table('setting')->get();
        //$data['jobs'] = Jobs::orderBy('sort_order', 'asc')->where('is_active', '=', 1)->paginate(2);
		$data['jobs'] = Jobs::orderBy('id', 'desc')->where('is_active', '=', 1)->paginate(10);
        return View::make('primary.jobs', $data);
    }
    
    public function insurance() 
    {
        return View::make('primary.insurance');
    }
    public function insurancePost() 
    {
        //var_dump(request()->all());die();
        $rules = array(
            
            'membership_number' => 'required',
            'email' => 'required',
            'name' => 'required',
            'mobile_number' => 'required',
            'quality_type' => 'required',
            'year_qualified' => 'required',
            'country_qualified' => 'required',
            'address' => 'required',
            'emirates' => 'required',
            'po_box' => 'required',
            'number_three' => 'required',
            'number_four' => 'required',
            'number_five' => 'required',
            'number_six' => 'required',
            );

       $validator = Validator::make(request()->all(), $rules);
       if ($validator->fails())
        {
            return Redirect::to('/insurance')->withErrors($validator)->withInput();
        }
        else{

            $trainer = Trainer::getTrainerByMemNum(request()->get('membership_number'));
           
           
                
                


                if($trainer){
                     $insurance_fee = 708.75;
                    $email = 'mail@repsuae.com';
                    $phone = $trainer['mobile_phone'];

                    $comment = 'Customer email: ' . $email;
                    $comment .= ' Customer mobile: ' . $phone;
                    $comment .= $insurance_fee != 0 ? ' (Insurance availed)' : '';

                    /*
                    $args = array(
                        'sid'=>Config::get('subscriptionPayment.seller_id'),
                        'product_id'=>Config::get('subscriptionPayment.product_id'),
                        'fixed'=>Config::get('subscriptionPayment.fixed'),
                        'quantity'=>1,
                        'user_email'=>$trainer['email']
                    );
                    
                    $link = Twocheckout_Charge::link($args);
                    
                    return Redirect::away($link);
                    */
                   
                    // initialize payfort data
                    $sha_in = Config::get('payfort.SHA_IN');
                    Session::put('payment_type', 'insurance');

                   
                    $amount = 708.75 * 100;
                    $currency = Config::get('payfort.CURRENCY');
                    $language = Config::get('payfort.LANGUAGE');
                    $order_id = date('mdYHms');
                    $pspid = Config::get('payfort.PSPID');

                    $str = '';
                    $str .= 'AMOUNT=' . $amount . $sha_in;
                    $str .= 'COM=' . $comment . $sha_in;
                    $str .= 'CURRENCY=' . $currency . $sha_in;
                    $str .= 'EMAIL=' . $email . $sha_in;
                    $str .= 'LANGUAGE=' . $language . $sha_in;
                    $str .= 'ORDERID=' . $order_id . $sha_in;
                    $str .= 'OWNERTELNO=' . $phone . $sha_in;
                    $str .= 'PSPID=' . $pspid . $sha_in;

                    $shasign = strtoupper(sha1($str));

                    $payfort_data = array(
                        'AMOUNT' => $amount,
                        'COM' => $comment,
                        'CURRENCY' => $currency,
                        'EMAIL' => $email,
                        'LANGUAGE' => $language,
                        'ORDERID' => $order_id,
                        'OWNERTELNO' => $phone,
                        'PSPID' => $pspid,
                        'SHASIGN' => $shasign,
                        'RETURN_URL' => url(),
                    );

                    
                     $data = array(
                
                        'membership_number'=>request()->get('membership_number'),
                        'email'=>request()->get('email'),
                        'name'=>request()->get('name'),
                        'mobile_number'=>request()->get('mobile_number'),
                        'birthdate'=>request()->get('birthdate'),
                        'quality_type'=>request()->get('quality_type'),
                        'year_qualified'=>request()->get('year_qualified'),
                        'country_qualified'=>request()->get('country_qualified'),
                        'address' => request()->get('address'),
                        'emirates' => request()->get('emirates'),
                        'po_box' => request()->get('po_box'),
                        'is_disable'=>request()->get('number_three'),
                        'is_criminal'=>request()->get('number_four'),
                        'is_injury'=>request()->get('number_five'),
                        'is_insurer'=>request()->get('number_six'),
                    );

                   
                
                   Mail::send('emails.insurance', $data, 
                    function($message) {
                        $message->to('membership@repsuae.com', 'REPS Admin')
                                ->subject('New Insurance Registration');
                    });
                    
                    return View::make('payfort.process', $payfort_data);
                }
                else
                {
                    return Redirect::to('/insurance')->withErrors($validator)->withInput()->with('alert', 'Membership Number Was not Found');
                }


               

            
        }
    }
    
    public function onlineMarketing()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.onlineMarketing',$data);
    }

    public function arabic()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('arabic.index',$data);
    }
    
    private function notifyREPs($input) {
        
        $data = array(
            'name'=>$input['name'],
            'email'=>$input['email'],
            'msg'=>$input['message']
        );
        
        Mail::send('emails.contactNotification', $data, 
        function($message) {
            $message->to(Config::get('contact.emailContactto'), 'REPS Admin')
                    ->subject('Someone has contacted REPs through the website!');
        });
    }
    
    public function contactAjx() {
        
        $input = request()->all();
        $result = array('status'=>0);
        
        if (empty($input['firstname'])) {
            $validator = Validator::make($input, array(
                'name' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required',
                'email' => 'required|email',
            ));

            if ($validator->fails()) {                
                $msgs = array();
                try {
                    foreach ($validator->messages()->toArray() as $msg) { 
                        // $msgs[] = $msg[0]; 
                        $msgs = $msg[0]; 
                    }
                } catch (Exception $e) {
                    
                }
                
                // $result = array('status'=>1, 'message'=>  implode("<br />", $msgs));
                $result = array('status'=>-1, 'message'=> $msgs);
            } else {
                // reCAPTCHA validation
                if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                    // Google secret API
                    $secretAPIkey = '6Ld3xqoUAAAAAGv2qBj51YlKGcY8FayCZ3B4kvEq';

                    // reCAPTCHA response verification
                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);

                    // Decode JSON data
                    $response = json_decode($verifyResponse);
                        if($response->success){
                            // echo 'success';
                            $this->notifyREPs($input); //UnComment 
                        $result = array('status'=>1, 'message'=> "Your message has been sent!");
                        } else {
                            // echo 'Fail';
                            $result = array('status'=>-1, 'message'=> "reCaptcha validation failed");
                        }
                        // echo '<pre>';print_r($response); // exit;
                }
            }
        }
        return Response::json($result);
    }
    
    /* 
     * 
     * Created By Kevin @ Cranium Creations
     */
    public function ethics () 
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.ethics',$data);
    }

    /**
     * Show the meet the team page.
     * 
     * @author Chris @ Cranium Creations
     */
    public function meetTheTeam()
    {
       $data['team'] =  DBS::table('team')->get();
        // dd($data);
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.meetTheTeam',$data);
    }

    

    /**
     * Show the faq page.
     *
     * @author Chris @ Cranium Creations
     */
    public function faqs()
    {

        $data['setting'] = DBS::table('setting')->get();
        $data['faqs']= FAQ::orderBy('sort_order', 'asc')
            ->where('is_active', 1)
            ->get(); 

        return View::make('primary.faqs', $data);
    }

    /**
     * Show the employer page.
     *
     * @author Chris @ Cranium Creations
     */
    public function employer()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.employer',$data);
    }

    public function survey()
    {

        $data['setting'] = DBS::table('setting')->get();
        $file = '/REPs_UAE_Working_in_Fitness_Survey_2019_-_Executive_Summary.pdf';
        
        // s
        //return response()->download($filePath, $fileName, $headers);
        return View::make('primary.survey',$data);
    }

    /**
     * Show terms and conditions page.
     *
     * @author Chris @ Cranium Creations
     */
    public function termsConditions()
    {
        $data['terms'] =  DBS::table('footer')->where('pages','Terms and Conditions')->get();
         
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.termsConditions',$data);
    }
    
    public function privacyPolicy()
    {
       $data['privacy'] =  DBS::table('footer')->where('pages','Privacy Policy')->get();

       $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.privacyPolicy',$data);
    }
    
    /**
     * Shows standards page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function standard()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.standard',$data);
    }
    
    /**
     * Shows global registers page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function globalRegisters()
    {
         $data['global'] =  DBS::table('footer')->where('pages','Global Partners')->get();

        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.globalRegisters',$data);
    }
    
    /**
     * Shows marketing page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function marketingResources()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.marketingResources',$data);
    }
    
    /**
     * Shows partners page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function partners()
    {
        $data['partners']= Partner::orderBy('sort_order', 'asc')->get(); 
        $data['setting'] = DBS::table('setting')->get(); 
        return View::make('primary.partners', $data); 
    }

    public function blog()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('primary.blog', $data);
    }
	
}