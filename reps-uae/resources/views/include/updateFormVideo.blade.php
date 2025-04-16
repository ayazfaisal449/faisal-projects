<script src="/js/tinymce/tinymce.min.js"></script>

{!!Form::open(array(
        'files'=> true,
        'url' => Request::root().'/admin/'.$form.'/save',
        'name' => 'addNew.$update',
        'class' => 'addForm'
        
        ))
    !!}

{!!Form::token()!!}
<div class="form-wrapper">
                 
    @for($i = 0; $i < count($input); $i++) @if($input[$i][1]=='textarea' ) <div class="row">
        <div class="large-7 columns">
            {!!Form::label($input[$i][0],$input[$i][2]." ".$errors->first($input[$i][0], ':message'))!!}
            {!!Form::textarea($input[$i][0],$input[$i][3])!!}
        </div>
</div>
@elseif($input[$i][1] == 'hidden')
{!!Form::hidden($input[$i][0],$input[$i][3])!!}
@elseif($input[$i][1] == 'text')
<div class="row">
    <div class="large-7 columns">
        {!!Form::label($input[$i][0],$input[$i][2])!!}
        <span class="redText">* {!! $errors->first($input[$i][0], ':message') !!}</span>
        {!!Form::text($input[$i][0],$input[$i][3])!!}
    </div>
</div>
@elseif($input[$i][1] == 'select')
<div class="row">
    <div class="large-7 columns">
        {!!Form::label($input[$i][0],$input[$i][2])!!}
        <span class="redText">* {!! $errors->first($input[$i][0], ':message') !!}</span>
        {!!Form::select($input[$i][0],$input[$i][4],$input[$i][3])!!}
    </div>
</div>
@endif

@if ($input[$i][0] == 'image')
<div class="row">
    <div class="large-7 columns">
        {!! Form::label($input[$i][0], $input[$i][2]) !!}
        <span class="redText">* {!! $errors->first($input[$i][0], ':message') !!}</span>
        <label for="files">
            <div class="upload"></div>
        </label>
        {!! Form::file($input[$i][0], ['id' => 'files']) !!}
        <span class="filename files"></span>
    </div>
</div>
@if (!empty($input[$i][3]))
<div class="row">
    <div class="large-12 columns">
        {!! Form::label('current', 'Current Image') !!}
        <img style="max-height: 300px; margin-top: 40px; margin-bottom: 40px;" src="{!! Request::root() !!}/{!! $input[$i][3] !!}">
    </div>
</div>
@endif
@endif

@endfor

@if(isset($subForm) && !empty($subForm))

@include('include.subForm')

@endif

<div class="row">
    <div class="large-7 columns">
        <input class="btn-background" type="submit" value="Update" />
    </div>
</div>

</div>
{!!Form::close()!!}



@section('customScripts')

$(document).ready(function(){
$("input[type=file]").change(function() {
$('.filename.' + $(this).attr('id')).empty();
var files = $(this)[0].files;
for (var i = 0; i < files.length; i++) { var $p=$("<p>
    </p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
    }
    });
    });

    @stop