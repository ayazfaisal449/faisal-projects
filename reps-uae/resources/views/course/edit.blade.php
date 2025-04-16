@extends('layouts.admin')

@section('content')

	 <div class="tools">
        <h1>Course</h1>
    </div>	
				
        {!! Form::open(array(
            'url'=>action('CourseController@saveCourse'),
            'files' => true,
            'id'=>'addNewCourse',
            'class' => 'addForm'
        ))!!}               		
             
            <div class="form-wrapper">
            
                {!! Form::hidden('id',$course->id) !!}
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('courseType', 'Course Type ')!!}   
						<span class="redText">* {!! $errors->first('course_type', ':message') !!}</span>                      
                        {!!Form::select('courseType',$courseTypes,$course->course_type)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('registration_category_id', 'Entry Category ')!!}  
						<span class="redText">* {!! $errors->first('registration_category_id', ':message') !!}</span> 
                        {!!Form::select('registration_category_id',$registrationCategory,$course->registration_category_id)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('categoryCourse', 'CPD Category')!!}   
                        <span class="redText">* {!! $errors->first('category', ':message') !!}</span>             
                        <select name="category" id="categoryCourse">
                            <option value=""  disabled> Select Category</option>
                            <option @if($course->category == 1) selected @endif  value="1" >Exercise Science</option>
                            <option @if($course->category == 2) selected @endif value="2" >Group Fitness</option>
                            <option @if($course->category == 3) selected @endif value="3" >Nutrition</option>
                            <option @if($course->category == 4) selected @endif value="4" >Mind &amp; Body</option>
                            <option @if($course->category == 5) selected @endif value="5" >Rehab &amp; SpecialPopulations</option>
                            <option @if($course->category == 6) selected @endif value="6" >Workshops &amp; Seminar</option>
                            <option @if($course->category == 7) selected @endif value="7" >Online</option>
<option @if($course->category == 8) selected @endif value="8" >Equipment Based</option>

                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">   
                        {!!Form::label('name', 'Course Name ')!!}  
						<span class="redText">* {!! $errors->first('name', ':message') !!}</span>                             
                        {!!Form::text('name',$course->name)!!} 
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">  
                        {!!Form::label('description', 'CPD Points ')!!}   
						<span class="redText">* {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description',$course->description)!!}
                    </div>
                </div>          
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('courseProvider', 'Course Provider ')!!}  
						<span class="redText">* {!! $errors->first('course_provider_id', ':message') !!}</span>   
<!--                                                 <select id="courseProvider" name="courseProvider">
                                               <?php // foreach($c_providers as $cp){ ?>
                                                  <option value="" <?php // if($cp['id']==$course->course_provider_id){echo 'selected';}?>><?php // echo $cp['name'];?></option>
                                               <?php // } ?>
                                                  </select>-->
                        {!!Form::select('courseProvider',$courseProviders,$course->course_provider_id)!!}
                    </div>
                </div>
                
                 <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('awardingorganization', 'Awarding Organization')!!}   
						<span class="redText">* {!! $errors->first('awardingorganization', ':message') !!}</span>                    
                        {!!Form::text('awardingorganization',$course->awardingorganization)!!} 
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns"> 
                        <input type="checkbox" <?php if($course->pre_approved==1){ echo 'checked';} ?>  id="vehicle1" name="pre_approved" value="1"/>
                        <label for="vehicle1"> Pre Approved</label>
                    </div>
                </div>
			
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::submit('Update',array('name'=>'submit','class'=>'btn-background'))!!}
                    </div>
                </div>
                
            </div>
			
        {!! Form::close() !!}

@stop

@section('custom')
@stop