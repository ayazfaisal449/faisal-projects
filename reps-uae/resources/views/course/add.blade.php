@extends('layouts.admin')

@section('content')

	<div class="tools">	
        <h1>Course</h1>
    </div>
				
        {!! Form::open(array(
            'url'=>'admin/course/save',
            'files' => true,
            'id'=>'addNewCourse',
            'class' => 'addForm'
        ))!!}
        
            <div class="form-wrapper">
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('courseType', 'Course Type ')!!}   
						<span class="redText">* {!! $errors->first('course_type', ':message') !!}</span>                      
                        {!!Form::select('courseType',$courseTypes)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('registrationCategory', 'Entry Category')!!}   
						<span class="redText">* {!! $errors->first('registration_category_id', ':message') !!}</span>                  
                        {!!Form::select('registration_category_id',$registrationCategory)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('categoryCourse', 'CPD Category')!!}   
						<span class="redText">* {!! $errors->first('category', ':message') !!}</span>    			
                        <select name="category" id="categoryCourse">
                            <option value="" selected disabled> Select Category</option>
                            <option value="1" >Exercise Science</option>
                            <option value="2" >Group Fitness</option>
                            <option value="3" >Nutrition</option>
                            <option value="4" >Mind &amp; Body</option>
                            <option value="5" >Rehab &amp; SpecialPopulations</option>
                            <option value="6" >Workshops &amp; Seminar</option>
                            <option value="7" >Online</option>
<option value="8" >Equipment Based</option>

                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('name', 'Course Name ')!!}   
						<span class="redText">* {!! $errors->first('name', ':message') !!}</span>                    
                        {!!Form::text('name')!!} 
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'CPD Points ')!!}
						<span class="redText">* {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description')!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('courseProvider', 'Course Provider')!!}   
                        <span class="redText">* {!! $errors->first('course_provider_id', ':message') !!}</span>               
                        {!!Form::select('courseProvider',$courseProviders)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('awardingorganization', 'Awarding Organization')!!}   
						<span class="redText">* {!! $errors->first('awardingorganization', ':message') !!}</span>                    
                        {!!Form::text('awardingorganization')!!} 
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns"> 
                        <input type="checkbox" id="vehicle1" name="pre_approved" value="1"/>
                        <label for="vehicle1"> Pre Approved</label>
                    </div>
                </div>
                
                 		
			
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::submit('Create',array('name'=>'submit','class'=>'btn-background'))!!}
                    </div>
                </div>
                
            </div>
			
            {!! Form::close() !!}
		
@stop

@section('custom')
@stop