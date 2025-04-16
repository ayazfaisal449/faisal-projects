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
                <p class="pnl-name"><a href="{{Request::root()}}/admin/trainer/search?trainerType=1">Active Trainers</a></p>
                <p class="pnl-count">{{ str_pad($active, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
            <div class="pnl">
                <p class="pnl-name"><a href="{{Request::root()}}/admin/trainer/search?trainerStatus=3">On-Process</a></p>
                <p class="pnl-count">{{ str_pad($on_process, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
            <div class="pnl">
                <p class="pnl-name"><a href="{{Request::root()}}/admin/trainer/search?expire=0">Expiring This Month</a></p>
                <p class="pnl-count">{{ str_pad($expiring_now, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
            <div class="pnl">
                <p class="pnl-name"><a href="{{Request::root()}}/admin/trainer/search?expire=0">Expiring Next Month</a></p>
                <p class="pnl-count">{{ str_pad($expiring_nxt, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
            @if (count($pending_renewals) > 0)
                <div class="pnl">
                    <br />
                    <h4>Online Payments For Approval</h4>
                    <table width="100%">
                        <tr>
                            <td>Trainer</td>
                            <td style="width:140px;">Invoice #</td>
                            <td style="width:180px;">Certificates</td>
                            <td style="width:100px;text-align:center;">Action</td>
                        </tr>
                    @foreach ($pending_renewals as $itm)
                        <tr class="renList">
                            <td>
                                <strong style="font-size:14px;">
                                    <a href="{{ URL::to('admin/users/update', array('id'=>$itm['trainer']['user_id'])) }}" alt="View Trainer Details" title="View Trainer Details">
                                        {{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}
                                    </a>
                                </strong><br />
                                REPs Id: <strong>{{ $itm['trainer']['reps_id'] }}</strong>,&nbsp;&nbsp;
                                Exp: {{ $itm['trainer']['expiry_date'] }}
                            </td>
                            <td style="text-align:left;">
                                {{ $itm['details']->invoice_id }}<br />
                                Paid On: {{ $itm['payment_date'] }}
                            </td>
                            <td>
                                @if(!empty($itm['details']->certificates))
                                    @foreach ($itm['details']->certificates as $certificate)
                                        <a target="_blank" style="padding-right:12px;text-decoration:underline;display:block;" href="{{ Request::root() . '/tmp/renewals/' . $itm['trainer']['user_id'] . '/' . $certificate}}" alt="{{$certificate}}" title="{{$certificate}}">
                                            {{$certificate}}
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            <td style="vertical-align:middle;text-align:center;">
                                <a href="{{ URL::action('TrainerController@approvePayment', $itm['payment_id']) }}" alt="Confirm payment" title="Confirm payment" class="confirmPayApprove">
                                    <img src="{{Request::root()}}/img/admin/ico-tbl-active.png" alt="Confirm payment" title="Confirm payment" />
                                </a>
                                &nbsp;&nbsp;
                                <a href="{{ URL::action('TrainerController@approvePayment', $itm['payment_id']) }}" data-name="{{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}" data-email="{{ $itm['user']['users']->email }}" alt="Contact {{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}" title="Contact {{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}" class="contactTrainer">
                                    <img src="{{Request::root()}}/img/admin/ico-tbl-contact-t.png" alt="Contact {{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}" title="Contact {{ $itm['user']['users']->first_name . ' ' . $itm['user']['users']->last_name }}" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
    <div id="contactTrainer" title="Contact" style="display:none;">
        <form>
        {{Form::hidden('subject', 'REPs Payment')}} 
        {{Form::hidden('name', '', array('id'=>'name'))}} 
        {{Form::hidden('email', '', array('id'=>'email'))}} 
        <div class="form-wrapper">
            <div class="row">
                <div class="large-12 columns" style="font-size:14px;">
                    To: <span id="to"></span>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    {{Form::label('msg', 'You Message')}}  
                    {{Form::textarea('msg', '', array('rows'=>18))}} 
                </div>
            </div>
        </div>
        </form>
    </div>
@stop

@section('customScripts') 
    function sendMail() {
        var email = $("#contactTrainer #email").val();
        var name = $("#contactTrainer #name").val();
        var msg = $("#contactTrainer #msg").val();
        var x = $("#contactTrainer form").serialize();
        
        if (msg == '') {
            alert('Message is requried');
            $("#contactTrainer #message").focus();
            return false;
        }
        
        var trainer = $(this).data('id');
        var url = '{{ URL::action('AdminController@sendTrainerEmail') }}';
        var content = $(this);
        
        $.ajax({
            url:url,
            data:x,
            type:"POST",
            success:function(result) {
                if (!result.status) {
                    alert("Error encountered during sending");
                    return false;
                }
            }
        });
        
        return true;
    }

    $(document).ready(function(){
        $(".confirmPayApprove").click(function() { 
            if (confirm('Are you sure you want to approve this payment?')) {
                return true;
            }
            return false;
        });
        $(".contactTrainer").click(function() {
        
            var $email = $(this).data("email");
            var $name = $(this).data("name");
            
            $("#contactTrainer #email").val($email);
            $("#contactTrainer #name").val($name);
            $("#contactTrainer #msg").val("");
            $("#contactTrainer #to").html($name + '<br />(' + $email + ')');
            
            $("#contactTrainer").dialog({
                resizable: false,
                height:280,
                width:430,
                modal: true,
                fluid: true,
                buttons: {
                    Send:function() {
                        var status = sendMail();
                        if (status) {
                            $(this).dialog("close");
                        }
                    },
                    Cancel:function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            return false;
        });
    });
@stop
