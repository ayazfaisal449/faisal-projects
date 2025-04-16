<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Cranium CMS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylesheets/app.css') }}">
    <script src="{{ asset('js/vendor/modernizr-2.6.2.min.js') }}"></script>

    <style>
        .logoimg { text-align: center; margin-top: 30px; }
        #login { 
            background: url('/img/btn-sprites.png?1398849620') top left no-repeat;
            width: 180px;
            height: 40px;
            background-position: -10px -60px;
            color: #FFFFFF;
            border: none;
        }
        fieldset { background-color: #F7F7F7; }
        span.error, small.error { margin-bottom: 0px; }
    </style>
</head>
<body style="border-top:5px solid #32a543;">
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> or 
        <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> 
        to improve your experience.</p>
    <![endif]-->

    <div class="row">
        <div class="small-8 small-offset-2 large-4 large-offset-4 columns">
            <form name="login" method="POST" action="{{ url('/authenticate') }}">
              
                <p class="logoimg">
                    <img alt="logo" src="{{ url('/img/logo.png') }}" />
                </p><input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <label for="eMail">E-Mail</label>
                    <input type="text" name="email" id="eMail" />
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                    @if (!empty($message))
                        <div class="generalMessage">
                            <span class="{{ $message['status'] }}">
                                {{ $message['text'] }}
                            </span>
                        </div>
                    @endif
                </fieldset>
                <input type="submit" name="submit" value="Login" id="login" />
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-ui-1.10.3.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

    <script type="text/javascript">
        @yield('customScripts')
    </script>
</body>
</html>
