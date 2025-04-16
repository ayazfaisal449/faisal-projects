@extends('layouts.admin')

@section('content')

@include('include.userNotification')


<?php /* ?>
  @if(count($certificates))
  <div class="tools">
  <h1>Existing Certificates</h1>
  </div>

  <div class="galleryEdit">
  <div class="tableHeader">
  <ul>
  <li>Photo</li>

  </ul>
  </div>
  </div>

  <div class="galleryEdit">
  <div class="tableRows">
  <ul>
  @foreach($certificates as $certificate)
  <li>
  <a href="" alt="Delete Photo">
  <h6>{{$certificate}}</h6>
  {{ HTML::image(Request::root()."/trainer/".$data->trainer->user_id.'/certificate/'.$certificate, '', array('width'=>'50%'))}}
  </a>
  <div class="action">

  <span class="delete"></span>
  </a>
  </div>
  </li>
  @endforeach

  </ul>
  </div>
  </div>


  @else
  <h3>There are no existing photos</h3>
  @endif
  <?php */ ?>

<div class="tools">
    <h5 style="margin:15px;">Certificates Submited for Upgrade Status</h5>
</div>
<div class="galleryEdit">
    <div class="tableRows">
        <ul>                  
            <li>
				<?php /* ?><h6>{{$certificate}}</h6><?php */ ?>
				<?php 
				$ext = pathinfo($data->certificate, PATHINFO_EXTENSION);
				if($ext == "pdf") { ?>
					<a href="{{'/trainer/'.$data->trainer->user_id.'/status_upgrade/'.$upgrade_status->id.'/'.$data->certificate }}" target="_blank" style="font-size:13px;"><span style="text-decoration:underline;">{{ $data->certificate }}</span></a>
				<?php } else { ?>
				{{ HTML::image("/trainer/".$data->trainer->user_id.'/status_upgrade/'.$upgrade_status->id.'/'.$data->certificate, '', array('width'=>'50%')) }}
				<?php } ?>
            </li>  
        </ul>
    </div>
</div>

<div class="tools">

    {{ Form::open(array(
        'url' => Request::root().'/admin/trainer/update-status',
        'name' => 'updateStatus',
        'class' => 'addForm',
        'files' => 'true'
        ))
    }}

    {{ Form::token()}}
    {{ Form::hidden('id', $id) }}
    {{ Form::hidden('trainer_id', $data->trainer->id) }}
    <div class="form-wrapper"> 
		@if(Session::has('statusMsg'))
			<span class="error" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);color: #D2232A;">{{ Session::get('statusMsg') }}</span>
		@endif
		
		@if(Session::has('messageMsg'))
			<span class="error" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);color: #D2232A;">{{ Session::get('messageMsg') }}</span>
		@endif

        @for($i = 0; $i < count($input); $i++) 
            @if($input[$i][1] == 'textarea')
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label($input[$i][0],$input[$i][2]." ".$errors->first($input[$i][0], ':message'))}}
                        {{Form::textarea($input[$i][0],$input[$i][3])}}
                    </div>
                </div>
            @elseif($input[$i][1] == 'hidden')
                {{Form::hidden($input[$i][0],$input[$i][3])}}
            @elseif($input[$i][1] == 'text')
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label($input[$i][0],$input[$i][2]." ".$errors->first($input[$i][0], ':message'))}}
                        {{Form::text($input[$i][0],$input[$i][3])}}
                    </div>
                </div>
            @elseif($input[$i][1] == 'select')
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label($input[$i][0],$input[$i][2]." ".$errors->first($input[$i][0], ':message'))}}
                        {{Form::select($input[$i][0],$input[$i][4],$input[$i][3])}}
                    </div>
                </div>
            @endif
        @endfor
        
        <div class="row">
            <div class="large-7 columns">
                <label for="image">Attach File To Message </label>
                {{ Form::file('attachment', array('id'=>'msgfile', 'style'=>'display:block;')) }}
            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                <input class="btn-background" type="submit" value="Update" />
            </div>
        </div>
        
        <br /><br /><br /><br />

    </div>
    {{Form::close()}}

</div>

@stop