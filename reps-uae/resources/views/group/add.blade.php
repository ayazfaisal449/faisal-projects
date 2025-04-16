@extends('layouts.admin')

@section('content')

    <div class="tools">
		<h1>Group</h1>

        {{Form::open(array('url' => Request::root().'/admin/group/save', 'name' => 'addNewPermission'))}}
            {{Form::token();}}
            
           <h3>Group</h3>
            
           {{Form::label('name', 'Name '.$errors->first('name', ':message'));}}
           {{Form::text('name',Input::old('name'));}}
            
           <h3>Group Permissions {{$errors->first('permissions', ':message')}}</h3>
           

				@foreach($permissions as $index => $permission)
                    @if ($index % 4 == 0)
                        <div class="row">
                    @endif
                            <div class="large-{{ ($index + 1) == count($permissions) ? (4 - ($index % 4)) * 3 : 3 }} columns">
                                {{ Form::checkbox('permissions[$permission->name]', $permission->name,null,array('id'=>$permission->name));}}
                                {{Form::label($permission->name, $permission->title);}}
                            </div>
                    @if (count($permissions) == $index + 1 || ($index + 1) % 4 == 0)
                        </div>
                    @endif
				@endforeach
           
            
           <h3>Procced to create a new Group</h3>
           <input type="submit" value="Create" />
        {{Form::close()}}
@stop

@section('custom')
@stop