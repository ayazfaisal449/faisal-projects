@extends('layouts.admin')

@section('content')
<style>
    .info-panel-dashboard {
        padding:15px;
    }
    .info-panel-dashboard div.pnl {
        border-bottom:1px solid white;
        padding:8px 0px;
    }
    .info-panel-dashboard div p.pnl-name {
        margin:0px;
        padding:4px 0px;
        float:left;
    }
    .info-panel-dashboard div p.pnl-count {
        margin:0px;
        padding:4px 0px;
        float:right;
        background-color: #888888;
        color:white;
        width:70px;
        text-align:center;
        -webkit-border-radius: 18px;
        -moz-border-radius: 18px;
        border-radius: 18px;
    }
    .renList td {
        font-size:13px;
    }
    .pnl table tr td {
        vertical-align: top;
    }
</style>
    <div class="tools">
        <h1>Admin Dashboard</h1>
        <div class="row">
            @if (Session::has('message'))
                <div class="subnotify" style="padding:15px;color:red;">
                    <p style="">{{ Session::get('message') }}</p>
                </div>
            @endif
        </div>
        <div class="info-panel-dashboard">
            <div class="pnl">
                <label for="name">Course Name</label>
                <input type="text" id="name" name="name" value="">
            </div>

            <div class="pnl">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="">
            </div>

            <div class="pnl">
                <label for="price">Price (AED)</label>
                <input type="number" id="price" name="price" value="">
            </div>

            <div class="pnl">
                <label for="points">Points</label>
                <input type="number" id="points" name="points" value="">
            </div>

            <div class="pnl">
                <label for="level">Level</label>
                <select id="level" name="level">
                    <option value="cpd">CPD</option>
                    <option value="entry">Entry</option>
                </select>
            </div>

            <div class="pnl">
                <label for="course_provider_id">Provider</label>
                <select id="course_provider_id" name="course_provider_id">
                    <option value="">Select a Provider</option>
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pnl">
                <label for="description">Description</label>
                <textarea id="description" name="description" style="height: 200px;"></textarea>
            </div>

            <div class="pnl">
                <button type="button" id="save-course">Save</button>
            </div>
        </div>
    </div>
@stop

@section('customScripts')
    load_course();

    function load_course()
    {
        return fetch('https://repsuae.volution.fit/api/v1/admin/courses/{{ $id }}/load', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then((response) => response.json())
        .then((responseJson) => {

            $('#name').val(responseJson.name);
            $('#date').val(responseJson.date);
            $('#price').val(responseJson.price);
            $('#points').val(responseJson.points);
            $('#level option[value="'+responseJson.level+'"]').attr('selected', 'selected');
            $('#course_provider_id option[value="'+responseJson.course_provider_id+'"]').attr('selected', 'selected');
            $('#description').val(responseJson.description);

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });
    }

    $(document).on('click', '#save-course', function() {
        console.log('saving...');
        return fetch('https://repsuae.volution.fit/api/v1/admin/courses/{{ $id }}/save', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'PATCH',
                name: $('#name').val(),
                date: $('#date').val(),
                price: $('#price').val(),
                points: $('#points').val(),
                level: $('#level').val(),
                description: $('#description').val(),
                course_provider_id: $('#course_provider_id').val()
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            if (responseJson.hasOwnProperty('errors')) {

                var first_error = Object.keys(responseJson.errors)[0];

                alert(responseJson.errors[first_error][0]);

            } else {

                alert('Course Saved');

            }

        })
        .catch(function(e) {

            alert('We could not save this course at the present time, please try again later.');

            console.log(e);
            console.log('ERROR');

        });
    });
@stop
