<h1>Edit Trainer</h1>

<div class="component" style="padding:0px 12px 12px;">
    <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
    <div class="clearfix"></div>
    <div class="tab_panel">
        <span class="tab_label tab_active">Personal Details</span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormWorkExperience', $data->id) !!}">Work Experience</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormQualifications', $data->id) !!}">Qualifications</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormComments', $data['id']) !!}">Comments</a></span>
    </div>
    <div class="clearfix"></div>
    <div class="the_form_content">
        {!! Form::model($data, [
            'action' => ['UsersController@save'],
            'class' => 'registration addForm',
            'files' => true,
        ]) !!}

        @if (Session::has('message'))
            <div class="subnotify" style="padding:0px;padding-bottom:15px;">
                {!! Session::get('message') !!}
            </div>
        @endif

        <div class="row">
            <div class="large-6 columns">
                {!! Form::token() !!}
                {!! Form::hidden('form', 'Personal Details') !!}
                {!! Form::hidden('id', $data->id) !!}

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('first_name', 'First Name') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('first_name', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('first_name', request()->old('first_name')) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('last_name', 'Last Name') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('last_name', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('last_name', request()->old('last_name')) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('gender', 'Gender') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('gender', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::select('trainer[gender]', $gender) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('dob', 'Date of Birth') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('dob', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('trainer[dob]', request()->old('trainer.dob'), ['id' => 'date']) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('city', 'City of Residence') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('city', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('trainer[city]', request()->old('trainer.city')) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('membership', 'Membership Number') !!}

                    </div>
                    {!! Form::text('trainer[membership]', request()->old('trainer.membership')) !!}
                </div>



            </div>

            <div class="large-6 columns">

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('nationality_id', 'Nationality') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('nationality_id', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::select('trainer[nationality_id]', $nationality, request()->old('trainer.nationality_id')) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('email', 'Email Address') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('email', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('email', request()->old('email')) !!}
                </div>
                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('mobile_phone', 'Mobile Phone') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('mobile_phone', ':message') !!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!! Form::text('trainer[mobile_phone]', request()->old('trainer.mobile_phone')) !!}
                </div>

                {!! Form::hidden('trainer[status_id]', request()->old('trainer.status_id')) !!}

                @if (isset($showme))
                    <div class="inputWrapper">
                        <div class="label">
                            {!! Form::label('status_id', 'Status') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('status_id', ':message') !!}</span>
                            </div>
                        </div>
                        @if ($data->trainer->status_id == 3)
                        {!! Form::select(
                            'trainer[status_id]', 
                            ['1' => 'Provisional', '2' => 'Full', '3' => 'Not Allocated'], 
                            old('trainer.status_id'), 
                            ['disabled' => 'disabled']
                        ) !!}
                        
                        @else
                            {!! Form::select('trainer[status_id]', ['1' => 'Provisional', '2' => 'Full'], request()->old('trainer.status_id')) !!}
                        @endif
                    </div>
                    <div class="inputWrapper">
                        <div class="label">
                            {!! Form::label('passport_no', 'Passport No') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('passport_no', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::text('trainer[passport_no]', request()->old('trainer.passport_no')) !!}
                    </div>
                @endif

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('emirates_id_no', 'Emirates ID') !!}
                        <!--  <div class="error">
                            <span class="error">{!! $errors->first('emirates_id_no', ':message') !!}</span>
                        </div> -->
                    </div>
                    {!! Form::text('trainer[emirates_id_no]', request()->old('trainer.emirates_id_no')) !!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('expiry_date', 'Expiry Date') !!}
                        <div class="error">
                            <span class="error">{!! $errors->first('expiry_date', ':message') !!}</span>
                        </div>
                    </div>
                    @if ($data->trainer->status_id == 3)
                        {!! Form::text('trainer[expiry_date]', request()->old('trainer.expiry_date'), [
                            'id' => 'expiry_date',
                            'disabled' => 'disabled',
                        ]) !!}
                        {!! Form::hidden('trainer[expiry_date]', request()->old('trainer.expiry_date'), ['id' => 'expiry_date']) !!}
                    @else
                        {!! Form::text('trainer[expiry_date]', request()->old('trainer.expiry_date'), ['id' => 'expiry_date']) !!}
                    @endif
                </div>

                <div class="inputWrapper">
                    <div class="label">
                        {!! Form::label('created_at', 'Created Date') !!}
                    </div>
                    {!! Form::text('trainer[created_at]', request()->old('trainer.created_at'), [
                        'readonly' => 'readonly',
                        'style' => 'color:#c0c0c0;',
                    ]) !!}
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <div class="inputWrapper pnl-border-top">
                        <div class="label">
                            {!! Form::label('image', 'Emirates ID Photo') !!}
                        </div>
                    </div>
                </div>
                <div class="large-7 columns">
                    <i>Recommended file types: png, jpg, jpeg, gif</i>
                    <label for="image" style="padding-left:0px;">
                        <div class="upload"></div>
                    </label>
                    {!! Form::file('image', ['id' => 'image']) !!}
                    <span class="filename image"></span>
                </div>
                <div class="large-5 columns">
                    @if ($data->trainer->image)
                        <img src="{{ url('/trainer/' . $data->id . '/image/' . $data->trainer->image) }}" alt="ID Photo"
                            class="user-img-prev" style="border:1px solid #c0c0c0;">
                    @endif
                </div>
            </div>



            <div class="row">
                <div class="large-12 columns">
                    <div class="inputWrapper pnl-border-top">
                        <div class="label">
                            {!! Form::label('e_certificate', 'E-certificate') !!}
                        </div>
                    </div>
                </div>
                <div class="large-7 columns">

                    <label for="e_certificate" style="padding-left:0px;">
                        <div class="upload"></div>
                    </label>
                    {!! Form::file('e_certificate', ['id' => 'e_certificate']) !!}
                    <span class="filename e_certificate"></span>
                </div>

                <div class="large-5 columns">
                    @if ($data->trainer->e_certificate)
                        <?php $ext = pathinfo($data->trainer->e_certificate, PATHINFO_EXTENSION); ?>

                        @if ($ext == 'doc' || $ext == 'docx')
                            <img width="140" src="{!! Request::root() !!}/img/docicon_doc.png"
                                alt="{!! $data->trainer->e_certificate !!}" title="{!! $data->trainer->e_certificate !!}" />
                        @elseif ($ext == 'pdf')
                            <img width="140" src="{!! Request::root() !!}/img/docicon_pdf.png"
                                alt="{!! $data->trainer->e_certificate !!}" title="{!! $data->trainer->e_certificate !!}" />
                        @else
                            <img src="{{ url('/trainer/' . $data->id . '/e_certificate/' . $data->trainer->e_certificate) }}"
                                alt="E-certificate" class="user-img-prev" style="border:1px solid #c0c0c0;">
                        @endif
                    @endif
                </div>

            </div>

            <!--  added  -->
            <div class="row">
                <div class="large-12 columns">
                    <div class="inputWrapper pnl-border-top">
                        <div class="label">
                            {!! Form::label('member_photo', 'Membership Card') !!}
                        </div>
                    </div>
                </div>
                <div class="large-7 columns">

                    <label for="member_photo" style="padding-left:0px;">
                        <div class="upload"></div>
                    </label>
                    {!! Form::file('member_photo', ['id' => 'member_photo']) !!}
                    <span class="filename photo"></span>
                </div>

                <div class="large-5 columns">
                    @if ($data->trainer->member_photo)
                        <?php $ext = pathinfo($data->trainer->member_photo, PATHINFO_EXTENSION); ?>

                        @if ($ext == 'doc' || $ext == 'docx')
                            <img width="140" src="{!! Request::root() !!}/img/docicon_doc.png"
                                alt="{!! $data->trainer->member_photo !!}" title="{!! $data->trainer->member_photo !!}" />
                        @elseif ($ext == 'pdf')
                            <img width="140" src="{!! Request::root() !!}/img/docicon_pdf.png"
                                alt="{!! $data->trainer->member_photo !!}" title="{!! $data->trainer->member_photo !!}" />
                        @else
                            <img src="{{ url('/trainer/' . $data->id . '/member_photo/' . $data->trainer->member_photo) }}"
                                alt="Member Photo" class="user-img-prev" style="border:1px solid #c0c0c0;">
                        @endif
                    @endif
                </div>

            </div>

            <div class="row">
                <div class="large-12 columns">
                    <div class="inputWrapper pnl-border-top">
                        <div class="label">
                            {!! Form::label('Upload Photo') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('photo', ':message') . $errors->first('photo_dimensions', ':message') !!}</span>
                                <span class="required">*</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="large-7 columns">

                    <i>Recommended size: Passport size (130px by 170px)</i><br />
                    <i>Accepted file types: Images only (PNG, JPG, GIF)</i>

                    <label for="photo" style="padding-left:0px;">
                        <div class="upload"></div>
                    </label>
                    {!! Form::file('photo', ['id' => 'photo']) !!}
                    <span class="filename photo"></span>
                </div>
                <div class="large-5 columns">
                    <img src="{{ url('/trainer/' . $data->id . '/photo/' . $data->trainer->photo) }}"
                        alt="User Profile Image" class="user-img-prev" style="border:1px solid #c0c0c0;">

                </div>
            </div>
            <hr>
            <div class="row hide">
                <div class="large-12 columns">
                    <div class="inputWrapper" style="background-color: #eee; padding: 10px;">
                        <h3 style="margin: 0">Insurance</h3>
                        <div class="label">
                            <label>
                                <b>Insured Member?</b>
                            </label>
                            <div class="error">
                                <span class="error">{!! $errors->first('avail_insurance', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::select('trainer[avail_insurance]', ['0' => 'No', '1' => 'Yes'], request()->old('trainer.avail_insurance')) !!}

                        <div class="label">
                            {!! Form::label('disease', 'Disabilities, transmittable diseases, or other impediment') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('disease', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::select('trainer[disease]', ['no' => 'No', 'yes' => 'Yes'], request()->old('trainer.disease')) !!}

                        <div class="label">
                            {!! Form::label('criminal', 'Convicted to any criminal/disciplinary offence') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('criminal', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::select('trainer[criminal]', ['no' => 'No', 'yes' => 'Yes'], request()->old('trainer.criminal')) !!}

                        <div class="label">
                            {!! Form::label('negligence', 'Injury/professional negligence for the last 3 years') !!}
                            <div class="error">
                                <span class="error">{!! $errors->first('negligence', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::select('trainer[negligence]', ['no' => 'No', 'yes' => 'Yes'], request()->old('trainer.negligence')) !!}

                        <div class="label">
                            <label style="text-align: left;">
                                Any insurer accept/cancel/refuse to continue in respect to <br>this type of insurance
                            </label>
                            <div class="error">
                                <span class="error">{!! $errors->first('insurer', ':message') !!}</span>
                            </div>
                        </div>
                        {!! Form::select('trainer[insurer]', ['no' => 'No', 'yes' => 'Yes'], request()->old('trainer.insurer')) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <div class="inputWrapper pnl-border-top">
                        <input class="submitBtn1 float-right admin-button" type="submit" value="Update"
                            name="register" />
                    </div>
                </div>
            </div>

            @if (isset($showme))
                <div class="form-wrapper" style="padding:0px;">
                    @if (isset($subForm) && !empty($subForm))
                        @include('include.subForm')
                    @endif

                    <div class="row">
                        <div class="large-7 columns">
                            <input class="btn-background" type="submit" value="Update" />
                        </div>
                    </div>
                </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
    @if (isset($showme))
        <script>
            $('.submitBtn1').click(function() {
                $(".submitBtn1").prop('disabled', 'disabled');
                $(".addForm").submit();
            });
        </script>
    @endif
