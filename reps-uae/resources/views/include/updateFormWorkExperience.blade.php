<h1>Edit Trainer</h1>

<div class="component" style="padding:0px 12px 12px;">		
    <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
    <div class="clearfix"></div>
    <div class="tab_panel">
        <span class="tab_label"><a href="{!! Request::root()."/admin/users/update/$data[id]" !!}">Personal Details</a></span>
        <span class="tab_label tab_active">Work Experience</span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormQualifications', $data['id']) !!}">Qualifications</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormComments', $data['id']) !!}">Comments</a></span>
    </div>
    <div class="clearfix"></div>
    <div class="the_form_content">
        {!! Form::model($data, array('action'=>array('UsersController@save2'),'class'=>'registration addForm','files'=>true)) !!}
        @if (Session::has('message'))
            <div class="subnotify" style="padding:0px;padding-bottom:15px;">
                {!! Session::get('message') !!}
            </div>
        @endif
        <div class="row">
            <div class="large-6 columns">
                {!!Form::token()!!}
                {!!Form::hidden('form','Work Experience')!!}
                {!!Form::hidden('id',$data['id'])!!}
                <div class="inputWrapper">
                    <div class="label">
                        {!!Form::label('job_title', 'Job Title')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('job_title', ':message')!!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!!Form::text('job_title',request()->old('job_title'))!!}
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="large-12 columns">
                <div class="inputWrapper pnl-border-top">
                    <div class="label">
                        {!!Form::label('Your Workplace')!!}
                    </div>
                </div>                        
            </div>
            <div class="clearfix"></div>
            <div class="large-6 columns">
                {!!Form::text('work_place[0]',request()->old('work_place0'))!!}
                {!!Form::text('work_place[1]',request()->old('work_place1'))!!}
                <!-- {!!Form::text('work_place[2]',request()->old('work_place2'))!!} -->
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <div class="inputWrapper pnl-border-top">
                    <div class="label">
                        {!!Form::label('Upload Your CV')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('cv', ':message')!!}</span>
                        </div>
                    </div>
                </div>                        
            </div>
            <div class="large-12 columns">
                <i>Recommended file types: pdf, doc, docx</i>
                <label for="cv" style="padding-left:0px;">
                    <div class="upload"></div>
                </label>
                
                <div class="clearfix"></div>
                {!!Form::file('cv',array('id'=>'cv'))!!}
                <span class="filename cv"></span>
                @if (!empty($data['cv']))
                    <a href="/trainer/{!!$data['id']!!}/cv/{!!$data['cv']!!}" target="_blank" style="font-size:13px;">Current CV File:  <span style="text-decoration:underline;">{!!$data['cv']!!}</span></a>
                @else
                    <span style="font-size:12px;">Current CV File:  <strong style="color:#c0c0c0;">No uploaded CV on file.</strong></span>
                @endif
            </div>
        </div>
        
        <div class="row">
            <div class="large-12 columns">
                <div class="inputWrapper pnl-border-top">
                </div>                        
            </div>
            <div class="large-6 columns end">
                <div class="inputWrapper">
                    <div class="label">
                        {!!Form::label('New Trainer Status')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('status_id', ':message')!!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    @if ($data['status_id'] == 3)
                        {!!Form::select('status_id',array('1'=>'Provisional','2'=>'Full','3'=>'Not Allocated'),request()->old('status_id'))!!}
                    @else
                         {!!Form::select('status_id',array('1'=>'Provisional','2'=>'Full'),request()->old('status_id'))!!}
                    @endif
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="inputWrapper pnl-border-top">
                    <div class="label">
                        {!!Form::label('Level of Registration')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('registration_category_id', ':message')!!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                </div>                        
            </div>
            <?php $x=1; ?>
            @foreach($regCategory as $reg)
                <?php $ischk = ''; ?>
                <div class="large-6 columns">
                    <div class="regLevelCheckBox clearfix">
                        {!!Form::label('reg'.$reg->id, ' '.$reg->level)!!}
                        @if (!empty($registration_category_id) && in_array($reg->id, $registration_category_id))
                            <?php $ischk = 'true'; ?>
                        @endif
                        {!!Form::checkbox('registration_category_id[]', $reg->id, $ischk,array('id' => 'reg'.$reg->id))!!}
                    </div>
                </div>
                <div class="clearfix"></div>
            @endforeach
        </div>
        
        <div class="row">
            <div class="large-12 columns">
                <div class="inputWrapper pnl-border-top">
                    <div class="label">
                        {!!Form::label('message_for_trainer', 'Message For Trainer')!!}
                    </div>
                    {!!Form::text('message_for_trainer',request()->old('message_for_trainer'))!!}
                    <div class="label">
                        {!!Form::label('attachment', 'Add attachment to message')!!}
                    </div>
                    {!!Form::file('attachment', array('style'=>'display:block;'))!!}
                    <input class="submitBtn1 float-right admin-button" type="submit" value="Update" name="register" />
                </div>   
            </div>
        </div>

    {!!Form::close()!!}
    </div>
</div>