<?php
namespace App\Http\Controllers;
require_once(__DIR__ . '/../../vendor/2checkout/2checkout-php/lib/Twocheckout.php');
use Carbon\Carbon;
use Cranium\Country\Models\Country;
use Cranium\Slider\Models\Slider;
use Cranium\FacilitySlider\Models\FacilitySlider;
use Cranium\Partner\Models\Partner;
use Cranium\Benefit\Models\Benefit;
use Cranium\FAQ\Models\FAQ;


class PrimaryController extends BaseController {
    
    /*
     * home page
     * Created By Kevin @ Cranium Creations
     */
    public function index ()   
    {
        $data['slider']= Slider::orderBy('sort_order', 'asc')->get();  
        $data['facility_slider']= FacilitySlider::orderBy('sort_order', 'asc')->get();  
        return View::make('primary.index',$data);
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
        $data['benefits']= Benefit::orderBy('sort_order', 'asc')->get(); 
        return View::make('primary.benefits', $data);
    }
    
    public function insurance() 
    {
        return View::make('primary.insurance');
    }
    public function insurancePost() 
    {
        //var_dump(Input::all());die();
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

       $validator = Validator::make(Input::all(), $rules);
       if ($validator->fails())
        {
            return Redirect::to('/insurance')->withErrors($validator)->withInput();
        }
        else{

            $trainer = Trainer::getTrainerByMemNum(Input::get('membership_number'));
           
           
                
                


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
                
                        'membership_number'=>Input::get('membership_number'),
                        'email'=>Input::get('email'),
                        'name'=>Input::get('name'),
                        'mobile_number'=>Input::get('mobile_number'),
                        'birthdate'=>Input::get('birthdate'),
                        'quality_type'=>Input::get('quality_type'),
                        'year_qualified'=>Input::get('year_qualified'),
                        'country_qualified'=>Input::get('country_qualified'),
                        'address' => Input::get('address'),
                        'emirates' => Input::get('emirates'),
                        'po_box' => Input::get('po_box'),
                        'is_disable'=>Input::get('number_three'),
                        'is_criminal'=>Input::get('number_four'),
                        'is_injury'=>Input::get('number_five'),
                        'is_insurer'=>Input::get('number_six'),
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
        return View::make('primary.onlineMarketing');
    }

    public function arabic()
    {
        return View::make('arabic.index');
    }
    
    private function notifyREPs($input) {
        
        $data = array(
            'name'=>$input['name'],
            'email'=>$input['email'],
            'msg'=>$input['message']
        );
        
        Mail::send('emails.contactNotification', $data, 
        function($message) {
            $message->to(Config::get('contact.emailContactFrom'), 'REPS Admin')
                    ->subject('Someone has contacted REPs though the website!');
        });
    }
    
    public function contactAjx() {
        
        $input = Input::all();
        $result = array('status'=>0);
        
        if (empty($input['firstname'])) {
            $validator = Validator::make($input, array(
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ));
            
            if ($validator->fails()) {
                
                $msgs = array();
                try {
                    foreach ($validator->messages()->toArray() as $msg) { 
                        $msgs[] = $msg[0]; 
                    }
                } catch (Exception $e) {
                    
                }
                
                $result = array('status'=>-1, 'message'=>  implode("<br />", $msgs));
            } else {
                
                $this->notifyREPs($input);
                
                $result = array('status'=>1, 'message'=> "Your message has been sent!");
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
        return View::make('primary.ethics');
    }

    /**
     * Show the meet the team page.
     * 
     * @author Chris @ Cranium Creations
     */
    public function meetTheTeam()
    {
        return View::make('primary.meetTheTeam');
    }

    /**
     * Show the about page.
     *
     * @author Chris @ Cranium Creations
     */
    public function about()
    {
        return View::make('primary.about');
    }

    /**
     * Show the faq page.
     *
     * @author Chris @ Cranium Creations
     */
    public function faqs()
    {
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
        return View::make('primary.employer');
    }

    public function survey()
    {
        return View::make('primary.survey');
    }

    /**
     * Show terms and conditions page.
     *
     * @author Chris @ Cranium Creations
     */
    public function termsConditions()
    {
        return View::make('primary.termsConditions');
    }
    
    public function privacyPolicy()
    {
        return View::make('primary.privacyPolicy');
    }
    
    /**
     * Shows standards page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function standard()
    {
        return View::make('primary.standard');
    }
    
    /**
     * Shows global registers page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function globalRegisters()
    {
        return View::make('primary.globalRegisters');
    }
    
    /**
     * Shows marketing page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function marketingResources()
    {
        return View::make('primary.marketingResources');
    }
    
    /**
     * Shows partners page.
     *
     * @author Kevin @ Cranium Creations
     */
    public function partners()
    {
        $data['partners']= Partner::orderBy('sort_order', 'asc')->get();  
        return View::make('primary.partners', $data); 
    }

    
	
}
