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

        <link rel="icon" type="image/png" href="{{ URL::to('favicon.png') }}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
		{{ HTML::style('css/stylesheets/app.css') }}
		{{HTML::style('css/calendar/default.css')}}				
       	
       	{{ HTML::script('js/admin/jquery-1.7.2.js') }}
        {{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}
		
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
		<div class="container admin">
			<div class="row">
				<div class="large-3 columns">
					@include('include.userSideNav')       
				</div>
				<div class="large-9 columns">
					<div id="content">
						@yield('content')
					</div>
				</div>
			</div>
		</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        	 {{ HTML::script('js/vendor/jquery-1.9.1.js') }}			
			 {{ HTML::script('js/vendor/jquery-ui-1.10.3.min.js') }}			
			 {{ HTML::script('js/admin/calendar/zebra_datepicker.js') }}
			<!-- Custom Js -->
			{{ HTML::script('js/admin/main.js') }}
			{{ HTML::script('js/admin/main.js') }}
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		
        <script type="text/javascript">
			@yield('customScripts')
        </script>
        
    </body>
</html>
