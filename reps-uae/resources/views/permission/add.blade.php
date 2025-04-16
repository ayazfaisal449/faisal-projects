@extends('layouts.admin')

@section('content')
    <div class="tools">
		<h1>Permission</h1>
        
        {{Form::open(array('url' => Request::root().'/admin/permission/save', 'name' => 'addNewPermission'))}}
			{{Form::token();}}
            
            {{Form::label('name', 'Name '.$errors->first('name', ':message'));}}
            {{Form::text('name',Input::old('name'));}}
            {{Form::label('title', 'Title '.$errors->first('title', ':message'));}}
            {{Form::text('title',Input::old('title'));}}
            
            <h3>Procced to create a new User</h3>
            <input type="submit" value="Create" />
            
		{{Form::close()}}
        
	</div>

@stop