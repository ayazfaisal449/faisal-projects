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
            <h4>App Blogs</h4>

            <a href="{{Request::root()}}/admin/blog/add"><button type="button" id="save-course">Add New</button></a>

            <table width="100%" id="table1">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Category Name</td>
                        <td>Status</td>
                        <td style="width:200px;text-align:center;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($blogs) > 0)
                    @foreach($blogs as $key => $value) 
                    <tr class="tableRows">
                        <td>{{$value->title}}</td>
                        <td>{{$value->category_title}}</td>
                        <td class="action">
                            <ul>
                                <li>
                                <div class="action" style="  justify-content: center; align-items: center; text-align: center; margin: 0 auto; ">
                                    <?php if($value->publish_status==0){?>
                                        <a href="{{Request::root()}}/admin/blog/changeStatus/{{$value->id}}/1">
                                            <span class="deactive"></span>
                                        </a>
                                    <?php }else{?>
                                    <a href="{{Request::root()}}/admin/blog/changeStatus/{{$value->id}}/0">
                                       <span class="active"></span>
                                    </a>
                                    <?php }?> 
                                </div>
                                </li>
                            </ul>
                        </td>
                        <td class="action">
                            <ul>
                                <li>
                                    <div class="action" style=" display: flex; justify-content: center; align-items: center; text-align: center; width: 30%; margin: 0 auto; ">
                                        <a href="{{Request::root()}}/admin/blog/update/{{$value->id}}">
                                            <span class="edit"></span>
                                        </a>
                                        <a href="{{Request::root()}}/admin/blog/delete/{{$value->id}}">
                                            <span class="delete"></span>
                                        </a>
                                    </div>
                                </li>
                            </ul>


                        </td>
                    </tr>
                    <!--                        <li style="height:40px;">
                                                    <span class="sort">{{$value->title}}</span>
                                                    
                                                    
                                            </li>-->
                    @endforeach
                    @else
                <h5 class="noRecords">There are no records to manage</h5>
                @endif

<!--                    <tr>
    <td>qqq</td>
    <td>eeee</td>
    <td>cccc</td>

</tr>
<tr>
    <td>qqq</td>
    <td>eeee</td>
    <td>cccc</td>
</tr>-->

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
