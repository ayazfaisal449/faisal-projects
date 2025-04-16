<h1>Edit Trainer</h1>

<div class="component" style="padding:0px 12px 12px;">      
    <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
    <div class="clearfix"></div>
    <div class="tab_panel">
        <span class="tab_label"><a href="{!! Request::root()."/admin/users/update/".$data->id !!}">Personal Details</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormWorkExperience', $data->id) !!}">Work Experience</a></span>
        <span class="tab_label"><a href="{!! URL::action('UsersController@userFormQualifications', $data['id']) !!}">Qualifications</a></span>
        <span class="tab_label tab_active">Comments</span>
    </div>
    <div class="clearfix"></div>
    <div class="the_form_content">
        <div class="row">
            <div class="large-12">
                <div style="padding: 20px;">
                    <form action="{!! URL::action('UsersController@saveComment') !!}" method="POST">
                    {!!Form::label('comment', 'Add Comment')!!}
                    <input type="hidden" name="user_id" value="{!! $data->id !!}">
                    <textarea name="comment" style="height: 100px;"></textarea>
                    <button type="submit" class="submitBtn1 float-right admin-button">Add</button>
                    </form>
                    <h3 style="margin:32px 12px 6px 16px;border-bottom:0px;">Comments History</h3>
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Comment</td>
                                <td width="30%">Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{!! $comment->comment !!}</td>
                                <td>{!! $comment->created_at !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>