@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Home Slider <a href="{!!Request::root()!!}/admin/slider/add">Add New</a></h1>
        <div>
            @include('include.slider')
        </div>
    </div>
    <hr>
    <form action="{!! URL::action('SliderController@saveMarketing') !!}" method="POST" enctype="multipart/form-data">
    	{!! Form::token() !!}
    	<div class="row" style="padding-left: 12px;">
		    <div class="large-7 columns">
		    	<h5>Marketing Thumbnail <span class="redText">*</span></h5>  
				<div>
					<img src="/images/marketing-thumb.jpg">
				</div>
				<i style="font-size:12px;">Recommended resolution: 200x300</i>
		        <label for="files">
		            <div class="upload"></div>
		        </label>
		        <input id="files" name="image" type="file">
		        <span class="filename files"></span>
		    </div>
		</div>
		<div class="row" style="padding-left: 12px;">
	        <div class="large-7 columns">
	            <input class="btn-background" type="submit" value="Update">
	        </div>
	    </div>
    </form>
@stop