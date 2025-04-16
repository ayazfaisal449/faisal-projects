@extends('layouts.primary')

@section('content')
        
    <div class="row">
        <div class="large-12 columns">
            <h1>Trainer Registration Form</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Trainer Qualification</h1>
        </div>
    </div>
          
    <div class="row">
        <div class="large-12 columns">
        
        {{Form::open(array(
                'url' => Request::root().'/trainer/dashboard/add-new-cpd-courses',
                'files' => true, 
                'name' => 'addNewCpdCourses'
            ))}}
            
            {{Form::token();}}
            {{Form::hidden('form','CpdCourses')}}
            
            <div class="cpd-courses">
                
               
                    {{Form::label('cpd_course', 'CPD Course Name ')}}
                    
                     {{ Form::select('cpd_course[]',$cpdcourses) }}
                    
              
                
               
                    {{Form::label('course_provider', 'Name of Institution')}}
                    {{Form::text('course_provider[]',(isset($oldData[0]['course_provider'])?$oldData[0]['course_provider']:''))}}
               
                
               
                    {{Form::label('date_completed', 'Date Completed')}}
                    {{Form::text('date_completed[]',(isset($oldData[0]['date_completed'])?$oldData[0]['date_completed']:''), array('class'=>'dateC'))}}
              
                
             
                    {{Form::label('certificates0', 'Certificate Scans')}}
                    {{Form::file('certificates0[]',array('class'=>'certificates','id'=>'certificates0','multiple'=>'multiple'))}}
               
            </div>
            
            <div class="moreQualification">
            
               
                
            </div>
             
            
            <a id="more">Add More CPD Courses</a>
             
            <h3>Proceed to Save</h3>
           
			<input type="submit" value="Register" name="register" />
            
        {{Form::close()}}
        
        </div>
    </div>
@stop

@section('customScripts')

    var $count = {{isset($errors)?count($errors):1}},
        $clone = $('.qualification').clone();

    // add the remove button
    function removeQualification() {
    
        $('.moreQualification .qualification').each(function (index) {
            //remove button
            if($(this).find('.remove').length == 0) {
                $('<div class="remove">Remove</div>').appendTo($(this));
                $(this).find('.remove').click(function () {
                    $(this).parent().remove();
                    $count--;
                     console.log($count);
                });
            }
            
        });
    }
    
    //clone the form to add more qualifications
    function addQualification() {
    
        if($count < 5) {
            $($clone.clone()).appendTo('.moreQualification');
            
            //increment count
            $count++;
        }
    }

    $('document').ready(function () {
    
        $('#more').click(function() {
            
            if($count < 5) {
            
                //add Qualification
                addQualification();
                
                //removeQualification
                removeQualification();

                $('.certificates').each(function (index) {
                    $(this).attr('name','certificates'+index+'[]');
                    $(this).attr('id','certificates'+index);
                    $(this).prev().attr('for','certificates'+index);
                });

            }
            else 
            {
                alert('you can add only 5 qualifications at a single time');
            }
            
        });
        
    });
    
@stop
