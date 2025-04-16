    
    <div class="tools">
        <h1>Delete Video</h1>
    </div>
        
    {{Form::open(array(
        'url' => Request::root().'/admin/'.$form.'/delete',
        'name' => 'deleteNew.$update',
        'class' => 'addForm'
        ))
    }}
        
        <div class="form-wrapper">
            <div class="row">
                <div class="large-7 columns">
                    <input type="hidden" name="id" value="{{$data['id']}}" /> 
                    <input class="btn-background" type="submit" value="Delete" />
                </div>
            </div>
        </div>
        
	{{Form::close()}}