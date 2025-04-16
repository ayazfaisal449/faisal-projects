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
                    <h4>Edit a Trainer</h4>
                    <input type="text" id="membership_number" name="membership_number" placeholder="Enter membership number">

                    <button type="button" id="search-trainer">Search</button>
                </div>

                <div class="pnl">
                    <br />
                    <h4>Trainer Approval</h4>
                    <table width="100%" id="table1">
                        <tr>
                            <td>Name</td>
                            <td>Created</td>
                            <td>Certificates</td>
                            <td style="width:100px;text-align:center;">Action</td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
@stop

@section('customScripts')
    load_approvals();

    function load_approvals()
    {
        console.log('loading...');
        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/pending/', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then((response) => response.json())
        .then((responseJson) => {

            var tbody = $("<tbody />"),tr;
            $.each(responseJson,function(_,obj) {
                tr = $("<tr class='tableRows' id='"+obj.id+"' />");
                tr.append("<td>" + obj.first_name + " " + obj.last_name + "</td>");
                tr.append("<td>" + obj.created_at + "</td>");
                var certificates = $("<td />");
                $.each(obj.certificates,function(_,cert) {
                    certificates.append('<a target="blank" href="' + cert.full_path + '">' + cert.path + '</a><br>');
                });
                certificates.append('</td>');
                tr.append(certificates);
                tr.append('<td class="action"><a href="/admin/app-trainers/'+obj.id+'/edit" data-id="'+obj.id+'"><img src="{{Request::root()}}/img/admin/ico-tbl-active.png" alt="Confirm payment" title="Confirm payment" /></a>&nbsp;<a href="javascript:void(0);" data-id="'+obj.id+'" class="decline-trainer"><img src="https://repsuae.com/img/admin/delete.png"></a></td>');
                tr.appendTo(tbody);
            });
            tbody.appendTo("#table1"); // only DOM insertion

            console.log(responseJson);
            console.log('SUCCESS');

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });
    }

    /**
     * Approve Trainer
     *
     */
    $(document).on('click', '.accept-trainer', function() {

        var user_id = $(this).data('id');

        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/pending/approve', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'PATCH',
                user_id: user_id
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            window.location.href = '/admin/app-trainers/' + user_id + '/edit';

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });

    });

    /**
     * Search a  Trainer
     *
     */
    $(document).on('click', '#search-trainer', function() {

        var membership_number = $('#membership_number').val();

        if (membership_number === '') {
            alert('Enter a membership number');
            return false;
        }

        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/search', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'POST',
                membership_number: membership_number
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            if (responseJson.status === 'success') {

                window.location.href = '/admin/app-trainers/' + responseJson.user_id + '/edit';

            }

            else {

                alert(responseJson.message);

            }

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });

    });

    /**
     * Decline Trainer
     *
     */
    $(document).on('click', '.decline-trainer', function() {

        var user_id = $(this).data('id');

        return fetch('https://repsuae.volution.fit/api/v1/admin/trainers/pending/decline', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'PATCH',
                user_id: user_id
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            $('#' + user_id).remove();

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });

    });
@stop
