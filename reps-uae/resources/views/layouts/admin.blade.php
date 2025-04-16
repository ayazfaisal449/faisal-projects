<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>REPs UAE CMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="icon" type="image/png" href="{{ URL::to('favicon.png') }}">
        {{-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'> --}}
        <script src="{{ asset('js/admin/jquery-1.7.2.js') }}"></script>
        <script src="{{ asset('js/vendor/modernizr-2.6.2.min.js') }}"></script>
        
        <link rel="stylesheet" href="{{ asset('css/stylesheets/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/calendar/default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui/jquery-ui-1.10.4.custom.min.css') }}">
        
       	
        <style>
            li, a, p, td {
                font-family: "OpenSans-Regular";
            }
            .hdr-top-bg {
                background: url('/../img/admin/introBackground.png?1397038725') top left repeat;
            }
            .sideNav span {
                font-family: "OpenSans-Regular";
            }
            nav ul li:last-child {
                border-bottom:0px;
            }
            .lnk-trainer {
                background-color:#32A543;
            }
            .adminWelcome a.logo img.adminlogo {
                height:60px !important;
            }
            .adminWelcome a.logo span {
                font-family: "OpenSans-Bold";
                color:#32A543;
                margin-top:8px;
                font-size:18px;
            }
            .greetings {
                padding-top:30px;
            }
            .greetings h6 {
                font-family: "OpenSans-Regular";
                float:left;
                font-size:14px;
            }
            .greetings a {
                float:right;
                padding-top:4px;
                font-size:14px;
            }
            .pnl-logo {
                background-color:#F2F2F2;
                padding-top:12px;
                padding-bottom:12px;
            }
            @media (max-width: 64.063em) {
                .greetings {
                    padding-top: 8px;
                    padding-bottom: 8px;
                }
            }
            .tableRows ul li .action a .active {
                background: url('/../img/admin/ico-tbl-active.png') no-repeat;
                width: 22px;
                height: 18px;
                display: inline-block;
                margin: 0 10px;
            }
            .tableRows ul li .action a .deactive {
                background: url('/../img/admin/ico-tbl-deactive.png?1399527062') no-repeat;
                width: 18px;
                height: 18px;
                display: inline-block;
                margin: 0 10px;
            }
            .ui-datepicker .ui-datepicker-title select { font-size:13px; }
            .tools h1 a, .tools h1 a,
            .tools h1 a, .tools h1 a:hover {
                padding: 10px 0;
            }
            .ui-widget-header {
                background-color:#32A443;
                background-image:none;
            }
            select.ui-datepicker-month, 
            select.ui-datepicker-year { padding:2px 8px;height:auto;}
            .tools h1 a, .tools h1 a:hover {
                background: url('/img/admin/addNew.png?1398849620') top left no-repeat;
            }
            #contactTrainer { padding:4px; }
            #contactTrainer .form-wrapper {
                padding:0px;
            }
        </style>        		
    </head>
    <body class="admin">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="container admin">
        
            @if (isset($showme))
                <div class="adminWelcome">
                    <div class="row" style="background-color:blue;">
                        <div class="large-3 columns">
                            <a class="logo" href="{{Request::root()}}/admin">
                                <img alt="logo alqasba" src="{{Request::root()}}/img/logo.png" />
                            </a>
                        </div>
                        <div class="large-9 columns end hdr-top-bg">
                             <div class="adminHeader clearfix">
                                <h6 class="clearfix">Hello <b>Admin!</b> Welcome to the Administration board</h6>
                                <a href="{{ URL::action('AdminController@logOut') }}" class="clearfix">
                                    <img src="{{Request::root()}}/img/admin/adminLogout.png" />
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="adminWelcome">
                <div class="row hdr-top-bg">
                    <div class="large-3 columns pnl-logo" style="">
                        <a class="logo" href="{{Request::root()}}/admin">
                            <img class="adminlogo" alt="logo alqasba" src="{{Request::root()}}/img/logo.png" />
                            <span>REPs UAE Admin</span>
                        </a>
                    </div>
                    <div class="large-9 columns greetings">
                        <h6 class="clearfix">Hello <b>Admin!</b> Welcome to the Administration board</h6>
                        <a href="{{ URL::action('AdminController@logOut') }}" class="clearfix">
                            <img src="{{Request::root()}}/img/admin/adminLogout.png" />
                            Logout
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="large-3 columns" style="background-color:#AAAAAA;padding:0px;">
                    <div class="sideNav" style="">
                        @include('include.adminSideNav')
                    </div>
                </div>
                <div class="large-9 columns" style="background: #F2F2F2;">
                    <div id="content" style="padding-top:12px;">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        	 
        <script src="{{ asset('js/vendor/jquery-1.9.1.js') }}"></script>
        <script src="{{ asset('js/vendor/jquery-ui-1.10.3.min.js') }}"></script>
        
        <!-- Js For Date Picker -->
        <script src="{{ asset('js/admin/calendar/zebra_datepicker.js') }}"></script>
        
        <!-- Custom Js -->
        <script src="{{ asset('js/admin/main.js') }}"></script>
        
             
            
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		
        <script type="text/javascript">
            $(function() {
                $(".dateC").datepicker({
                    changeMonth: true,
                    changeYear: true, 
                    minDate: "-100Y",
                    maxDate: "+0D",
                    dateFormat:'yy-mm-dd',
                    yearRange: "-100:+0D",
                    showMonthAfterYear:true
                });
            });
            @yield('customScripts')
        </script>
        
    </body>
</html>
