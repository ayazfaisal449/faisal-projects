@extends('layouts.admin')

@section('content')

	<div class="tools">
		<h1>Users</h1>
		{{Form::open(array('url' => Request::root().'/admin/users/save', 'name' => 'addNewUser'))}}
			{{Form::token();}}
			
			<h3>Personal Details</h3>
			
				{{Form::label('first_name', 'First Name '.$errors->first('first_name', ':message'));}}
				{{Form::text('first_name',Input::old('first_name'));}}
				{{Form::label('last_name', 'Last Name '.$errors->first('last_name', ':message'));}}
				{{Form::text('last_name',Input::old('last_name'));}}
				{{Form::label('email', 'Email Address '.$errors->first('email', ':message'));}}
				{{Form::email('email',Input::old('email'));}}
				{{Form::label('password', 'Password '.$errors->first('password', ':message'));}}
				{{Form::password('password');}}
				
			<h3>Group   {{$errors->first('groups', ':message')}}</h3>
            
            @foreach($groups as $index => $group)
                @if ($index % 4 == 0)
                    <div class="row">
                @endif
                        <div class="large-{{ ($index + 1) == count($groups) ? (4 - ($index % 4)) * 3 : 3 }} columns">
                            {{ Form::checkbox('groups[]', $group->id,null,array('id'=>$group->id));}}
                            {{Form::label($group->id, $group->name);}}
                        </div>
                @if (count($groups) == $index + 1 || ($index + 1) % 4 == 0)
                    </div>
                @endif
            @endforeach
			
			<h3>Procced to create a new User</h3>
			<input type="submit" value="Create" />
		{{Form::close()}}
	</div>


	<div class="row">
		<div class="large-12 small-12 columns">
			
		</div>
	</div>
@stop