@extends('layouts.admin')

@section('content')
        
    <div class="row">
        <div class="large-12 columns">
            <h1>Trainer has been successfully registered</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <h6>The Trainer with id <b>{{ Session::get('new_reps_user_id') }}</b> can now successfully sign in with their user credentials</h6>
        </div>
    </div>
    
@stop
    