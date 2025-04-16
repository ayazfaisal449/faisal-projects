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
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="">
            </div>

            <div class="pnl">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="">
            </div>

            <div class="pnl">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="">
            </div>

            <div class="pnl">
                <label for="membership_number">Membership Number</label>
                <input type="tel" id="membership_number" name="membership_number" value="">
            </div>

            <div class="pnl">
                <label for="email">Membership Categories</label>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-a" value="a"> <label for="cat-a">A (Personal Trainer)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-b" value="b"> <label for="cat-b">B (Gym Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-c" value="c"> <label for="cat-c">C (Group Fitness Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-d" value="d"> <label for="cat-d">D (Group Fitness Instructor Freestyle)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-e" value="e"> <label for="cat-e">E (Yoga Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-f" value="f"> <label for="cat-f">F (Pilates Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-g" value="g"> <label for="cat-g">G (Pilates Instructor Comprehensive)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-h" value="h"> <label for="cat-h">H (Aqua Fitness Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-i" value="i"> <label for="cat-i">I (Children's Fitness Instructor)</label><br>
                <input type="checkbox" class="membership_categories" name="categories[]" id="cat-j" value="j"> <label for="cat-j">J (Assistant Instructor)</label><br>
            </div>

            <div class="pnl">
                <button type="button" id="save-trainer">Save</button>
                <a href="/admin/approval" style="margin-left: 25px;">Return to Approvals</a>
            </div>
        </div>
    </div>
@stop

@section('customScripts')
    load_trainer();

    function load_trainer()
    {
        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/{{ $user_id }}/load', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then((response) => response.json())
        .then((responseJson) => {

            $('#first_name').val(responseJson.first_name);
            $('#last_name').val(responseJson.last_name);
            $('#email').val(responseJson.email);
            $('#membership_number').val(responseJson.trainer.membership_number);
            $('#emirates_id').val(responseJson.trainer.emirates_id);
            $('#membership_type option[value="'+responseJson.trainer.membership_type+'"]').attr('selected', 'selected');
            $('#comments').val(responseJson.trainer.comments);

            if (responseJson.trainer.membership_type === 'provisional') {

                $('#save-trainer').html('Save and Approve');

            }

            // Select Correct Categories
            if(jQuery.inArray("1", responseJson.trainer.categories) !== -1) {
                $('#cat-a').click();
            }
            if(jQuery.inArray("2", responseJson.trainer.categories) !== -1) {
                $('#cat-b').click();
            }
            if(jQuery.inArray("3", responseJson.trainer.categories) !== -1) {
                $('#cat-c').click();
            }
            if(jQuery.inArray("4", responseJson.trainer.categories) !== -1) {
                $('#cat-d').click();
            }
            if(jQuery.inArray("5", responseJson.trainer.categories) !== -1) {
                $('#cat-e').click();
            }
            if(jQuery.inArray("6", responseJson.trainer.categories) !== -1) {
                $('#cat-f').click();
            }
            if(jQuery.inArray("7", responseJson.trainer.categories) !== -1) {
                $('#cat-g').click();
            }
            if(jQuery.inArray("8", responseJson.trainer.categories) !== -1) {
                $('#cat-h').click();
            }
            if(jQuery.inArray("9", responseJson.trainer.categories) !== -1) {
                $('#cat-i').click();
            }
            if(jQuery.inArray("10", responseJson.trainer.categories) !== -1) {
                $('#cat-j').click();
            }

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });
    }

    $(document).on('click', '#save-trainer', function() {
        console.log('saving...');

        var ids = [];

        $('input[name="categories[]"]:checked').each(function(){
             ids.push($(this).val());
          });

        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/{{ $user_id }}/save', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'PATCH',
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                membership_number: $('#membership_number').val(),
                membership_type: $('#membership_type').val(),
                emirates_id: $('#emirates_id').val(),
                categories: ids,
                comments: $('#comments').val()
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            if (responseJson.hasOwnProperty('errors')) {

                var first_error = Object.keys(responseJson.errors)[0];

                alert(responseJson.errors[first_error][0]);

            } else {

                $('#save-trainer').html('Save');

                alert('Trainer Saved');

                window.location.href = 'https://repsuae.com/admin/approval';

            }

        })
        .catch(function(e) {

            alert('We could not save this trainer at the present time, please try again later.');

            console.log(e);
            console.log('ERROR');

        });
    });
@stop
