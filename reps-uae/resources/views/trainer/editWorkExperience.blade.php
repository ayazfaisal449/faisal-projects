@extends('layouts.primary')

@section('content')
        
    <div class="row">
        <div class="large-12 columns">
            <h1>Trainer Registration Form</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Work Place & Level of Registration </h1>
        </div>
    </div>
          
    <div class="row">
        <div class="large-12 columns">
        
            {{Form::open(array(
                'url' => Request::root().'/trainer/dashboard/updateTrainerWorkExperience',
                'files' => true, 
                'name' => 'addNewTrainer'
            ))}}
            
            {{Form::token();}}
            {{Form::hidden('form','Work Experience')}}           
            
            <h3>Work Place Details</h3>
            
            {{Form::label('work_place', 'Work Place '.$errors->first('work_place', ':message'))}}
            {{Form::text('work_place[]',Input::old('work_place[]'))}}
            {{Form::text('work_place[]',Input::old('work_place[]'))}}
            {{Form::text('work_place[]',Input::old('work_place[]'))}}
            
            <h3>Upload Your CV</h3>
            <i>Accepted file types:  Documents only (PDF, DOC)</i><br />
            <i>Limit size to 256000b</i>
            {{Form::label('cv', 'Trainer CV'.$errors->first('cv', ':message'))}}
            {{Form::file('cv',array('id'=>'cv'))}}

            <h3>Level of Registration</h3>

            <div class="row">
            @foreach($regCategory as $reg)
                <div class="large-12 columns">
                    {{Form::checkbox('registration_category_id[]', $reg->id, '',array('id' => 'reg'.$reg->id))}}
                    {{Form::label('reg'.$reg->id, $reg->level." ".$errors->first('registration_category_id', ':message'))}}
                </div>
            @endforeach
            </div>
            
            <h3>Continue .. </h3>
           
			<input type="submit" value="Continue" name="register" />
            
            {{Form::close()}}
            
        </div>
    </div>
    








            
           