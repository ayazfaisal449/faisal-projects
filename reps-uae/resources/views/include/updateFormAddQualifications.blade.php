<h1>Edit Trainer</h1>

<div class="component" style="padding:0px 12px 12px;">		
    <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
    <div class="clearfix"></div>
    <div class="tab_panel">
        <span class="tab_label"><a href="{!! Request::root()."/admin/users/update/".$data->id !!}">Personal Details</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormWorkExperience', $data->id) !!}">Work Experience</a></span>
        <span class="tab_label tab_active">Qualifications</span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormComments', $data['id']) !!}">Comments</a></span>
    </div>
    <div class="clearfix"></div>
    <div class="the_form_content">
        {!! Form::model($data, array('action'=>array('UsersController@save3'),'class'=>'registration addForm','files'=>true)) !!}
            <div class="large-12" style="margin-bottom:20px;">
                {!!Form::token()!!}
                {!!Form::hidden('id',$data->id)!!}
                {!!Form::hidden('form','Work Experience')!!}
                <div class="sub-tab_panel">
                    <span class="tab_label"><a href="{!! URL::action('UsersController@userFormQualifications', $data->id) !!}">View Uploaded Qualifications</a></span>
                    <span class="tab_label tab_active">Add New Qualifications</span>
                </div>
            </div>
        
            @if ($limit_reached)
                <div class="qualification">
                    <div class="large-12 columns">
                        Unable to add more qualifications.  The limit of 5 qualifications has already been reached.
                    </div>    
                    <div class="clearfix"></div>
                </div>
            @else
                <div class="qualification">
                    <div class="large-6 columns">
                        <div class="inputWrapper">
                            <div class="label">
                                {!!Form::label('course_name', 'Name of Course ')!!}
                                <div class="error">
                                    <span class="error">{!!$errors->first('course_name', ':message')!!}</span>
                                </div>
                            </div>
                            {!!Form::text('course_name',Input::old('course_name'))!!}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {!!Form::label('course_provider', 'Name of Institution ')!!}
                                <div class="error">
                                    <span class="error">{!!$errors->first('course_provider', ':message')!!}</span>
                                </div>
                            </div>
                            {!!Form::text('course_provider',Input::old('course_provider'))!!}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {!!Form::label('date_completed', 'Date Completed')!!}
                                <div class="error">
                                    <span class="error">{!!$errors->first('date_completed', ':message')!!}</span>
                                </div>
                            </div>
                            {!!Form::text('date_completed',Input::old('date_completed'), array('class'=>'dateC'))!!}
                        </div>
                    </div>

                    <div class="large-6 columns">
                        <div class="qualificationCertificate trainerSubTitle">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="inputWrapper">
                                        <div class="label xrr">
                                            {!!Form::label('Upload Certificates')!!}
                                            <div class="error">
                                                <span class="error">{!!$errors->first('certificates', ':message')!!}</span>
                                                <span class="required">*</span>
                                            </div>
											
                                        </div>
                                        <i style="font-size: 12px;display: block;">Recommended file types: png, jpg, jpeg</i>
                                        <i style="font-size: 12px;display: block;">Limit size to 2MB for each file</i>
                                    </div>                        
                                </div>
                                <div class="large-12 columns">
                                    <label for="certificates" style="padding-left:0px;padding-top:0px;">
                                        <div class="upload"></div>
                                    </label>
									
                                    {!! Form::file('certificates[]',array('class'=>'certificates','id'=>'certificates','multiple'=>'multiple')) !!}
									<span class="filename certificates"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <input class="submitBtn1 float-right admin-button" type="submit" value="Add Qualification" name="register" />
                        </div>   
                    </div>
                </div>
            @endif
        {!!Form::close()!!}
    </div>
</div>