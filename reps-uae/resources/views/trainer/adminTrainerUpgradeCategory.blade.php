@extends('layouts.admin')

@section('content')

@include('include.userNotification')



<div class="tools">
    <h5 style="margin:15px;">Certificates Submited for Upgrade Level of Registration</h5>
</div>
<div class="galleryEdit">
    <div class="tableRows">
        <ul>                  
            <li>
                <?php /* ?><h6>{{$certificate}}</h6><?php */ ?>
            	<?php 
				$ext = pathinfo($data->certificate, PATHINFO_EXTENSION);
				if ($ext == "pdf" || $ext == "doc" || $ext == "docx") { ?>
					<a href="{{ '/trainer/'.$data->trainer->user_id.'/level_upgrade/'.$upgrade_category_status->id.'/'.$data->certificate }}" target="_blank" style="font-size:13px;"><span style="text-decoration:underline;">{{ $data->certificate }}</span></a>
				<?php } else { ?>
				{{ HTML::image("/trainer/".$data->trainer->user_id.'/level_upgrade/'.$upgrade_category_status->id.'/'.$data->certificate, '', array('width'=>'50%'))}}
				<?php } ?>
            </li>  
        </ul>
    </div>
</div>

<div class="tools">

    {{ Form::open(array(
            'url' => Request::root().'/admin/trainer/update-level-category',
            'name' => 'updateStatus',
            'class' => 'addForm',
            'files' => 'true'
        ))
    }}

    {{ Form::token()}}
    {{ Form::hidden('id', $id) }}
    {{ Form::hidden('trainer_id', $data->trainer->id) }}
    <div class="form-wrapper"> 

       <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                
                  <h3>Level of Registration</h3>
                    
            </div>
        </div>
    </div>
          
     <div class="row">
	 	
        @if(Session::has('categoryMsg'))
                <span class="error" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);color: #D2232A;">{{ Session::get('categoryMsg') }}</span>
        @endif

        @if(Session::has('messageMsg'))
                <span class="error" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);color: #D2232A;">{{ Session::get('messageMsg') }}</span>
        @endif
		
		
        @foreach($regCategory as $reg)
            <div class="large-6 columns">
                <div class="regLevelCheckBox clearfix">
                    {{Form::label('reg'.$reg->id, ' '.$reg->level)}}
                    <?php $array = explode(',', $data->category); ?>
                    @if (in_array($reg->id, $array))
                        {{Form::checkbox('registration_category_id[]', $reg->id, 'true',array('id' => 'reg'.$reg->id, 'style' => 'width:20px;height:20px;margin-left:7px;'))}}
                    @else
                        {{Form::checkbox('registration_category_id[]', $reg->id, '',array('id' => 'reg'.$reg->id, 'style' => 'width:20px;height:20px;margin-left:7px;'))}}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
	<div class="row">
            <div class="large-7 columns">
                    <label for="message">Message </label>
                    {{Form::textarea('message', 'Your category has been updated!')}}      
            </div>
	</div>
        
        <div class="row">
            <div class="large-7 columns">
                <label for="image">Attach File To Message </label>
                {{ Form::file('attachment', array('id'=>'msgfile', 'style'=>'display:block;')) }}
            </div>
        </div>
	
	<div class="row">
            <div class="large-7 columns">
                <label for="status">Status </label>
                <select name="status" id="">
                    <option value="1">Approved</option>
                    <option value="0">Declined</option>
                </select>
                <hr>
                <input class="btn-background" type="submit" value="Update" />
            </div>
	</div>
        
        <br /><br /><br /><br />

    </div>
    {{Form::close()}}

</div>
@stop