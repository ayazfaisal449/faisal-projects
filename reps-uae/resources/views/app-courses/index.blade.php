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
                    <br />
                    <h4>App Courses</h4>

                    <a href="/admin/app-courses/create"><button type="button" id="save-course">Create Course</button></a>

                    <table width="100%" id="table1">
                        <tr>
                            <td>Name</td>
                            <td>Date</td>
                            <td style="width:100px;text-align:center;">Action</td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
@stop

@section('customScripts')
    load_courses();

    function load_courses()
    {
        return fetch('https://repsuae.volution.fit/api/v1/admin/courses/all/', {
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
                tr.append("<td>" + obj.name + "</td>");
                tr.append("<td>" + obj.date + "</td>");
                tr.append('<td class="action"><a href="/admin/app-courses/'+obj.id+'/edit/"><img src="https://repsuae.com/img/admin/edit.png?1445427525" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-id="'+obj.id+'" class="delete-course"><img src="https://repsuae.com/img/admin/delete.png"></a></td>');
                tr.appendTo(tbody);
            });
            tbody.appendTo("#table1"); // only DOM insertion

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });
    }

    $(document).on('click', '.delete-course', function() {
        var course_id = $(this).data('id');

        return fetch('https://repsuae.volution.fit/api/v1/admin/courses/' + course_id, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _method: 'DELETE'
            })
        })
        .then((response) => response.json())
        .then((responseJson) => {

            $('#' + course_id).remove();

            alert('Course Deleted!');

        })
        .catch(function(e) {

            console.log(e);
            console.log('ERROR');

        });
    });
@stop
