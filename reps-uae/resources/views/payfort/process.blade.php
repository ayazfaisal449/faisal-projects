@extends('layouts.primary')

@section('content')

    @include('include.subNav')
    
    {{-- @if (Session::get('testmode') == 'leo') --}}
    @if (true)
        <div class="border-bottom">
            <div class="row">
                <div class="large-12 columns">
                    <h1 class="color-green">Initializing Payfort Payment</h1>

                    <?php
					    // fazal@lbatechnologies
                        if ($EMAIL == "mudasir@sigmads.com" || $EMAIL == "pamreataza@hotmail.com" || $EMAIL == "faisal.ayaz@sigmads.com")  {

                        //     if($EMAIL == "arifhussain1@gmail.com"){
                            if($TYPE == 'new') {
                                $requestParams = array(
                                    'command' => 'PURCHASE',
                                    'access_code' => 'I9K55r0ECOc65QOvrTUv',
                                    'merchant_identifier' => 'kwHVFFrU',
                                    'merchant_reference' => $ORDERID,
                                    'amount' => $AMOUNT,
                                    'currency' => 'AED',
                                    'language' => 'en',
                                    'customer_email' => $EMAIL,
                                    'order_description' => 'REPS Membership',
									'return_url' => 'https://www.repsuae.com/payment/success'.'?type='.$payment_type,
                                    'merchant_extra' => $TYPE,
                                );

                            } else {
                                $requestParams = array(
                                    'command' => 'PURCHASE',
                                    'access_code' => 'I9K55r0ECOc65QOvrTUv',
                                    'merchant_identifier' => 'kwHVFFrU',
                                    'merchant_reference' => $ORDERID,
                                    'amount' => $AMOUNT,
                                    'currency' => 'AED',
                                    'language' => 'en',
                                    'customer_email' => $EMAIL,
                                    'order_description' => 'REPS Membership',
                                    'merchant_extra' => $TYPE,
                                    'merchant_extra1' => isset($FILES) ? $FILES : "",
                                    'merchant_extra2' => isset($TRAINER_ID) ? $TRAINER_ID : "",
                                );
                            }
                        } else{
                            if($TYPE == 'new') {
                                $requestParams = array(
                                    'command' => 'PURCHASE',
                                    'access_code' => '6sWrEGulfczlsvcG5PP4',
                                    'merchant_identifier' => 'thHUtaYP',
                                    'merchant_reference' => $ORDERID,
                                    'amount' => $AMOUNT,
                                    'currency' => 'AED',
                                    'language' => 'en',
                                    'customer_email' => $EMAIL,
                                    'order_description' => 'REPS Membership',
                                    'merchant_extra' => $TYPE,
                                );
                            } else {
                                $requestParams = array(
                                    'command' => 'PURCHASE',
                                    'access_code' => '6sWrEGulfczlsvcG5PP4',
                                    'merchant_identifier' => 'thHUtaYP',
                                    'merchant_reference' => $ORDERID,
                                    'amount' => $AMOUNT,
                                    'currency' => 'AED',
                                    'language' => 'en',
                                    'customer_email' => $EMAIL,
                                    'order_description' => 'REPS Membership',
                                    'merchant_extra' => $TYPE,
                                    'merchant_extra1' => isset($FILES) ? $FILES : "",
                                    'merchant_extra2' => isset($TRAINER_ID) ? $TRAINER_ID : "",
                                );
                            }
                        }
                        $shaString = '';
                        // sort an array by key
                        ksort($requestParams);
                        foreach ($requestParams as $key => $value) {
                            $shaString .= "$key=$value";
                        }
                        // make sure to fill your sha request pass phrase
                        $shaString = "$2y$10$2M7m79ghZ" . $shaString . "$2y$10$2M7m79ghZ";
                        $signature = hash("sha256", $shaString);
                        $requestParams['signature'] = $signature;

                        
                        if ($EMAIL == "mudasir@sigmads.com" || $EMAIL == "pamreataza@hotmail.com" || $EMAIL == "faisal.ayaz@sigmads.com")  {
                        // if($EMAIL == "arifhussain1@gmail.com"){
                        //dd('here'); 
                            $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
                        } else {
                        $redirectUrl = 'https://checkout.payfort.com/FortAPI/paymentPage';
                        }

                        echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
                        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
                        foreach ($requestParams as $a => $b) {
                            echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
                        }
                        echo "\t<script type='text/javascript'>\n";
                        echo "\t\tdocument.frm.submit();\n";
                        echo "\t</script>\n";
                        echo "</form>\n</body>\n</html>";
                    ?>
                </div>
            </div>
        </div>
    @else
        {{-- ======================================================================== --}}
        <div class="border-bottom">
            <div class="row">
                <div class="large-12 columns">
                    <h1 class="color-green">Initializing Payfort Payment</h1>
                    @if(1 == 2)
                    <form method="post" action="https://secure.payfort.com/ncol/test/orderstandard.asp" id="form1" name="form1" style="display:none;">
                    @else
                    <form method="post" action="https://secure.payfort.com/ncol/prod/orderstandard.asp" id="form1" name="form1" style="display:none;">
                    @endif

                        <!-- general parameters: see General Payment Parameters -->
                        <label for="AMOUNT">AMOUNT: </label><input type="text" name="AMOUNT" id="AMOUNT" value="{{ $AMOUNT }}"><br>
                        <label for="COM">COM: </label><input type="text" name="COM" id="COM" value="{{ $COM }}"><br>
                        <label for="CURRENCY">CURRENCY: </label><input type="text" name="CURRENCY" id="CURRENCY" value="{{ $CURRENCY }}"><br>
                        <label for="EMAIL">EMAIL: </label><input type="text" name="EMAIL" id="EMAIL" value="{{ $EMAIL }}"><br>
                        <label for="LANGUAGE">LANGUAGE: </label><input type="text" name="LANGUAGE" id="LANGUAGE" value="{{ $LANGUAGE }}"><br>
                        <label for="ORDERID">ORDERID: </label><input type="text" name="ORDERID" id="ORDERID" value="{{ $ORDERID }}"><br>
                        <label for="OWNERTELNO">OWNERTELNO: </label><input type="text" name="OWNERTELNO" id="OWNERTELNO" value="{{ $OWNERTELNO }}"><br>
                        <label for="PSPID">PSPID: </label><input type="text" name="PSPID" id="PSPID" value="{{ $PSPID }}"><br>
                        <!-- <input type="text" name="TP" value=""> -->
                        
                        <label for="PSPID">SHASIGN: </label><input type="text" name="SHASIGN" id="SHASIGN" value="{{ $SHASIGN }}"><br>
                        <!-- <input type="hidden" name="SHASIGN" value="8609707C048BDAF9CF8430A026A663FE572EFB97"> -->
                        <input type="submit" value="Submit" id="submit2" name="SUBMIT2">
                    </form>
                </div>
            </div>
        </div>

        <div class="swril cpdProviders"></div>
        <script>
            $(document).ready(function() {
                $('#form1').submit();
            });
        </script>
    @endif
@stop
