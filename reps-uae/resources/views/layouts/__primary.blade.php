<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Reps UAE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="icon" type="image/png" href="{{ URL::to('favicon.ico') }}">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

        {{ HTML::script('js/admin/jquery-1.7.2.js') }}
        {{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}



        {{ HTML::style('css/stylesheets/app.css') }}
        {{ HTML::style('css/jquery-ui/jquery-ui-1.10.4.custom.min.css') }}
        {{ HTML::style('js/fancybox/jquery.fancybox.css') }}
        {{ HTML::style('src_new/app.min.css') }}
        {{ HTML::style('src_new/responsive.css') }}
        {{ HTML::style('src_new/font-awesome.min.css') }}
		{{ HTML::style('css/lightbox.css') }}

        <style>
            .cpdList li { text-align:center;}
            .cpdList li a { display:inline-block;}
            .cpdList li img { vertical-align:middle;}
            .ui-datepicker .ui-datepicker-title select { font-size:13px; }
            .submitBtn { font-family:"HelveticaNeueLTCom-Bd";font-size: 14px;}
            .nav2 a span:hover {border: 1px outset #5ACD6B;}
            .subResource { margin-top:40px;}
            .subResource h2 { 
                font-family:"HelveticaNeueLTCom-Bd";
                font-size:16px;
                border-bottom:1px solid #c0c0c0;
                padding:6px 12px;
            }
            .subResource .subResourceItm {
                margin-top:40px;
            }
            .subResource .subResourceItm a {
                background:transparent url('{{ Request::root() . "/img/download.png"}}') no-repeat left center;
                padding:4px 0px 4px 40px;
                font-family:'HelveticaNeueLTCom-Bd';
                font-size:16px;
                color:#32A443;
            }.subResource .subResourceItm a.nop {
                display:block;
                margin-bottom:12px;
            }
            .subResource .subResourceItm p {
                margin:12px 0px;
            }
            .subResource .subResourceItm .subResourceImg {
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                border:1px solid #c0c0c0;
                text-align: center;
                padding:12px 4px;
            }
            .subResource .subResourceItm .subResourceImg p {
                text-align:left;
                font-family:'HelveticaNeueLTCom-Bd';
                font-size:16px;
                color:black;
                padding:12px 12px 0px 12px;;
            }
            div.backbtn {
                margin-top:40px;margin-bottom:40px;text-align:right;
            }
            div.backbtn a {
                padding:8px 30px;color:#32A543;border:1px solid #32A543;
            }
            .filename p { font-size:11px;margin-bottom:4px;}
            .ui-widget-header {
                background-color:#32A443;
                background-image:none;
            }
            select.ui-datepicker-month, 
            select.ui-datepicker-year { padding:2px 8px;height:auto;}
            @media (max-width:460px) {
                .greenWrapper {text-align:center;}
                .greenWrapper img { width:40%;}
                .greenWrapper a { display:block;}
            }
            .almostExpireRow .columns p,
            .expireRow .columns p {
                text-align:center;
                margin-top:50px;
                margin-bottom:40px;
                padding:20px 0px;
                font-family: HelveticaNeueLTCom-Th;
                font-size:2.75rem;
                color:white;
                -webkit-border-top-left-radius: 36px;
                -webkit-border-bottom-right-radius: 36px;
                -moz-border-radius-topleft: 36px;
                -moz-border-radius-bottomright: 36px;
                border-top-left-radius: 36px;
                border-bottom-right-radius: 36px;
            }
            .almostExpireRow .columns p {
                background-color:#32A543;
                font-size:1.5rem;
                padding:10px 0px;
            }
            .expireRow .columns p {
                background-color:red;
            }
            .payType {
                font-size:20px;
                text-align:center;
                margin-top:20px;
                color:#32A543;
            }
            .payType img {
            }
            .cashpy {
                border:3px solid #4d4d4d;
                -webkit-border-radius: 15px;
                -moz-border-radius: 15px;
                border-radius: 15px;
            }
            .onpy {
                border:3px solid #008FBE;
                -webkit-border-radius: 15px;
                -moz-border-radius: 15px;
                border-radius: 15px;
            }
            .paySteps {
                font-family: "OpenSans-Regular";
                font-size:16px;
            }
            .payupl {
                font-family: "OpenSans-Regular";
            }
            .paySteps li { font-size:14px;}
            .openSans * { font-family: "OpenSans-Regular";font-size:14px;}
            .trainerDashboardWrapper {
                height:auto !important;
                color:red;
                padding:30px 0px;
            }
            .trainerDashboardWrapper img {
                display:none;
            }
            header.siteHeader .row .socialMedia ul li:last-child {
                padding-right: 0px;
            }
            a.subFooter-btn:hover { background-color:#38B44A;}
            footer .contactWrapper a:hover { background-color: #474747;}
            footer .copywrite a:hover { text-decoration:underline;}
            @media (max-width: 945px) {
                footer .contactWrapper {
                    display:block;
                }
            }

            span.bg-cont {
                background-image: url('{{ Request::root() . "/img/bgBody.png"}}');
            }
        </style>
        {{ HTML::style('css/stylesheets/benefit.css') }}
    </head>
    <?php $segment1 = Request::segment(1);
    $segment2 = Request::segment(2); ?>
    <body class="<?php if ($segment1 == 'blog' || $segment1 == 'categry_post') {
        echo 'blog';
    } elseif ($segment1 == 'post') {
        echo 'blog_detail';
    } else {
        echo 'pushmenu-push';
    } ?> ">
        <nav class="pushmenu pushmenu-left">
            <div class="menu-right">
                <h3>Menu</h3>
                <ul class="social-mobile">
                    <li><a class="t" href="{{ URL::action('PrimaryController@arabic') }}"><img alt="U.A.E Flag"src="{{Request::root()}}/images/flag.png"> Arabic</a></li>
                    <li>
                        @if( !Sentry:: getUser() && !Sentry::check() )
                        <a class="" href="{{ action('TrainerController@logIn') }}">Sign In</a>
                        @else
                        <h1>hello</h1>
                        <a class="" href="{{ action('TrainerController@dashboard') }}">Account</a>
                        @endif</li>
                    <li style="border-bottom: 5px solid #32A543;margin-top: -1px;"></li>
                </ul>
                <ul class=" clearfix" >

                    <li>
                        <a class="single-liner" href="{{ action('TrainerController@registerInfo') }}">Register</a>
                    </li>
                    <li>
                        <a class="single-liner" href="{{ action('TrainerController@logIn') }}">Renew</a>
                    </li>
                    <li>
                        <a href="{{ action('TrainerController@trainerSearchUserIndex') }}">Find Trainer</a>
                    </li>
					<li>
							<a href="/gallery">Gallery</a>
					</li>
                    <li class="adrp"> <div class="dropdown"><a class="dropbtn">Get Qualified</a>
                            <div class="dropdown-content" style="margin-top: -12px;">                                
                                <a href="{{ action('CourseController@entryQualifications') }}">Entry Qualifications</a>
                                <a href="{{Request::root()}}/training/cpd-providers">CPD Courses</a>
                            </div>                              
                        </div>
                    </li>
                    <!-- <li>
                        <a href="{{ action('CourseController@entryQualifications') }}">Approved Training</a>
                    </li> -->
                    <li>  
                        <a class="single-liner" href="{{ action('PrimaryController@insurance') }}">Insurance</a>
                    </li>
                    <!--   <li>  
                          <a href="{{ action('PrimaryController@employer') }}">CPR Course</a>
                      </li> -->
                    <li style="border-bottom: 5px solid #32A543;margin-top: -1px;"></li>
                </ul>
                <ul class="sub-mobile clearfix">
                    <li>
                        <a href="{{ action('PrimaryController@faqs') }}"><span>FAQ</span></a>
                    </li>
                    <li>
                        <a href="{{ action('PrimaryController@ethics') }}"><span>Code of Ethics<span></a>
                                    </li>
                                    <li>
                                        <a href="{{ action('PrimaryController@standard') }}"><span>Standards</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ action('PrimaryController@benefits') }}"><span>Member Benefits</span></a>
                                    </li>
                                    </ul>
                                    </div>
                                    </nav>
                                    <!--[if lt IE 7]>
                                        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                                    <![endif]-->



                                    @include('include.newHeader')


                                    <div id="container">
                                        @yield('content')   
                                    </div>

                                    <div id="dlgComingSoon" title="Coming Soon" style="display:none;"><p>Coming soon!!!</p></div>
                                    @include('include.newFooter')


                                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

                                    {{ HTML::script('js/vendor/jquery-1.9.1.js') }}                             
                                    {{ HTML::script('js/vendor/jquery-ui-1.10.3.min.js') }}
                                    {{ HTML::script('js/vendor/jquery.backstretch.min.js') }}
                                    {{ HTML::script('js/remodal.js') }}     
                                    <!--  Js For Date Picker -->            
                                    {{ HTML::script('js/admin/calendar/zebra_datepicker.js') }}            

                                    <!-- Custom Js -->
                                    {{ HTML::script('js/admin/main.js') }}  

                                    <!-- Fancy Box image Slider -->
                                    {{ HTML::script('js/fancybox/jquery.fancybox.js?v=2.1.5') }}

                                    <!-- carousel -->
                                    {{ HTML::script('js/jquery.carouFredSel-6.2.1.js') }}
                                    {{ HTML::script('src_new/slick.min.js') }}
									{{ HTML::script('js/lightbox.js') }}

                                    <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
                                    <!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUTF1nWoG9NEjR-1ZOiier1ZvzS1gcFbk&callback=initialize"></script>-->
                                    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUTF1nWoG9NEjR-1ZOiier1ZvzS1gcFbk&callback"></script>
                                    <script type="text/javascript">
                            $(document).ready(function () {
                            //Mobile Menu
                            $('.left-nav').click(function (e) {
                            e.preventDefault();
                            $('.mobileNav').animate({
                            height:"toggle"
                            }, 900);
                            });
                            });
                            $('.sndmsg').click(function (e) {
                                e.preventDefault();
                                $('.errorsss').html('');

                                var f_name = $('.f_name').val();
                                var f_maill = $('.f_mail').val();
                                var f_msg = $('.f_msg').val();
                                var f_g_recaptcha_response = $('.g-recaptcha-response').val();
                                if(f_name == ''){
                                    $('.cont_frm_err_name').css('display','block');
                                    console.log('name emp');
                                }
                                if(f_maill == ''){
                                    $('.cont_frm_err_mail').css('display','block');
                                }
                                if(f_msg == ''){
                                        $('.cont_frm_err_msg').css('display','block');
                                }
                                if(f_g_recaptcha_response == ''){
                                        $('.cont_frm_err_capt').css('display','block');
                                }

                                var indata = $(".msgrepss").serialize();
                                var url = '{{ URL::action('PrimaryController@contactAjx') }}';
								setTimeout(function() { 
                                        grecaptcha.reset();
                                        $('.cont_frm_err').css('display','none');
                                }, 4000);
								if (f_name.trim() != '' && f_maill.trim() != '' && f_msg.trim() != '' && f_g_recaptcha_response.trim() != ''){
                                $.ajax({url:url, data:indata, type:"POST", success:function(result) {
                                    if (result.status === - 1) {
                                        console.log('errr');
                                        $('.errorsss').html(result.message);
                                        $('.cont_frm_errord').html(result.message);
                                        $('.cont_frm_errord').css('display','block');
                                    } else if (result.status === 1) {
                                        // alert(result.message);
                                        $('.cont_frm_success').html(result.message);
                                        $('.cont_frm_success').css('display','block');
                                        $(".msgrepss").find("input[type=text], textarea").val("");
                                    }
									
                                }});
								}
                            });
                            $('.btnComingSoon').click(function() {
                            $("#dlgComingSoon").dialog({
                            resizable: false,
                                    height:230,
                                    width:230,
                                    modal: true,
                                    fluid: true,
                                    buttons: {
                                    Ok: function() {
                                    $(this).dialog("close");
                                    }
                                    }
                            });
                            return false;
                            });
                            $(document).ready(function() {
                            $menuLeft = $('.pushmenu-left');
                            $nav_list = $('#nav_list');
                            $nav_list.click(function() {
                            $(this).toggleClass('active');
                            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
                            $menuLeft.toggleClass('pushmenu-open');
                            });
                            });
                                    </script>

                                    <script type="text/javascript">
                                        @yield('customScripts')
                                    </script>
                                    <script>
                                                $(document).ready(function(){
                                        var size = $('.pagination li').length;
                                        $('.pagination li').eq(0).addClass('prev_slide');
                                        $('.pagination li').eq(size - 1).addClass('next_slide');
                                        })
                                    </script>
                                    </body>
                                    </html>