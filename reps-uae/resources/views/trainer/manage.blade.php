@extends('layouts.admin')
@section('content') 
<script type="text/javascript">
function isNumberKey(evt) {
    
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;

    return true;
}
</script>
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
    .trainerTable tbody td a .active {
        background: url('{{Request::root()}}/img/admin/ico-tbl-active.png') no-repeat;
        width: 22px;
        height: 18px;
        display: inline-block;
        margin: 0 10px;
    }
    .trainerTable tbody td a .deactive {
        background: url('{{Request::root()}}/img/admin/ico-tbl-deactive.png?1399527062') no-repeat;
        width: 18px;
        height: 18px;
        display: inline-block;
        margin: 0 10px;
    }
    /*.pnl-name a { color:black;}*/
</style>
<div class="tools">
<h1>Trainer Management <?php /*?><a class="addNew" href="{{Request::root()}}/admin/downloadTrainer">Download</a><?php */?> 
	<a style="background: url('/../img/admin/add_trainer.jpg') no-repeat;" class="addNew" href="{{Request::root()}}/admin/trainer/registration"></a> 
<a style="" class="" href="{{ URL::action('TrainerController@refresh') }}">Refresh</a> 
</h1>
    <div class="row" style="padding:15px;">
    <div class="medium-6 column">
        <div class="info-panel-dashboard">
            <div class="pnl">
                <p class="pnl-name trainerStyle trainer1"><a href="{{Request::root()}}/admin/trainer/search?trainerType=1">Active Trainers</a></p>
                <p class="pnl-count">{{ str_pad($active, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
            <div class="pnl">
                <p class="pnl-name"><a href="{{Request::root()}}/admin/trainer/search?trainerStatus=3">On-Process</a></p>
                <p class="pnl-count">{{ str_pad($on_process, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="medium-6 column">
        <div class="info-panel-dashboard">
            <div class="pnl">
                <p class="pnl-name expire0"><a href="{{Request::root()}}/admin/trainer/search?expire=0">Expiring This Month</a></p>
                <p class="pnl-count">{{ str_pad($expiring_now, 2, "0", STR_PAD_LEFT)}}</p>
                <div class="clearfix"></div>
            </div>
            <div class="pnl">
                <p class="pnl-name expire1"><a href="{{Request::root()}}/admin/trainer/search?expire=1">Expiring Next Month</a></p>
                <p class="pnl-count">{{ str_pad($expiring_nxt, 2, "0", STR_PAD_LEFT) }}</p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
    
<div style="margin:0 15px;">
<form name="search" method="post" action="{{Request::root()}}/admin/trainer/search" >
        <input type="text" name="trainer" placeholder="Search by Name" value="{{ !empty($q['trainer']) ? $q['trainer'] : '' }}" style="max-width: 370px;margin-right: 20px;float: left;" />
	
	<select id="selectBox"  name="param" style="max-width: 305px; float:left;margin-right:20px;">
            <option value="" >Select</option>
            <option class="trainerType" value="1" {{(isset($q['trainerType']) && $q['trainerType'] == '1') ? 'selected' : ''}}>Active Trainers</option>
            <optgroup label="Expiring/Expired Trainers">
                <option class="expire" value="-1" {{(isset($q['expire']) && $q['expire'] == -1) ? 'selected' : ''}}>Expired</option>
                <option class="expire" value="0" {{(isset($q['expire']) && $q['expire'] == 0) ? 'selected' : ''}}>Expiring This Month</option>
                <option class="expire" value="1" {{(isset($q['expire']) && $q['expire'] == 1) ? 'selected' : ''}}>Expiring Next Month</option>
            </optgroup>
            <optgroup label="Select Gender">
                <option class="gender" value='0' {{(isset($q['gender']) && $q['gender'] == '0') ? 'selected' : ''}}>Male</option>
                <option class="gender" value='1' {{(isset($q['gender']) && $q['gender'] == '1') ? 'selected' : ''}}>Female</option>
            </optgroup>
            <optgroup label="Select Trainer Upgrade Level/Status">
                <option class="upgradeRequest" value='level' {{(isset($q['upgradeRequest']) && $q['upgradeRequest'] == 'level') ? 'selected' : ''}}>Trainer Upgrade Level</option>
                <option class="upgradeRequest" value='status' {{(isset($q['upgradeRequest']) && $q['upgradeRequest'] == 'status') ? 'selected' : ''}}>Trainer Upgrade Status</option>
            </optgroup>
            <optgroup label="Select Registration Category Level">                  		
                @foreach($levels as $level)
                    <option class="registrationCategory" value='{{ $level->id }}' {{(isset($q['registrationCategory']) && $q['registrationCategory'] == $level->id) ? 'selected' : ''}}>{{ $level->level }}</option>
                @endforeach
            </optgroup>
            <optgroup label="Select Trainer Status">
                    <option class="trainerStatus" value='1' {{(isset($q['trainerStatus']) && $q['trainerStatus'] == '1') ? 'selected' : ''}}>Provisional</option>
                    <option class="trainerStatus" value='2' {{(isset($q['trainerStatus']) && $q['trainerStatus'] == '2') ? 'selected' : ''}}>Full</option>
                    <option class="trainerStatus" value='3' {{(isset($q['trainerStatus']) && $q['trainerStatus'] == '3') ? 'selected' : ''}}>Not Allocated</option>
            </optgroup>
            <optgroup label="Select Age Range">
                <option class="trainerAge" value='1' {{(isset($q['trainerAge']) && $q['trainerAge'] == '1') ? 'selected' : ''}}>24 years old or younger</option>
                <option class="trainerAge" value='2' {{(isset($q['trainerAge']) && $q['trainerAge'] == '2') ? 'selected' : ''}}>25 to 34 years old</option>
                <option class="trainerAge" value='3' {{(isset($q['trainerAge']) && $q['trainerAge'] == '3') ? 'selected' : ''}}>35 to 44 years old</option>
                <option class="trainerAge" value='4' {{(isset($q['trainerAge']) && $q['trainerAge'] == '4') ? 'selected' : ''}}>45 to 54 years old</option>
                <option class="trainerAge" value='5' {{(isset($q['trainerAge']) && $q['trainerAge'] == '5') ? 'selected' : ''}}>55 to 64 years old</option>
                <option class="trainerAge" value='6' {{(isset($q['trainerAge']) && $q['trainerAge'] == '6') ? 'selected' : ''}}>65 years or older</option>
            </optgroup>
	</select>
	<input class="hiddenParams" id="gender" type="hidden" name="gender" />
	<input class="hiddenParams" id="upgradeRequest" type="hidden" name="upgradeRequest" />
	<input class="hiddenParams" id="registrationCategory" type="hidden" name="registrationCategory" />
	<input class="hiddenParams" id="trainerStatus" type="hidden" name="trainerStatus" />
        <input class="hiddenParams" id="trainerAge" type="hidden" name="trainerAge" />
        <input class="hiddenParams" id="trainerType" type="hidden" name="trainerType" />
        <input class="hiddenParams" id="expire" type="hidden" name="expire" />
	<input type="submit" value="Search" style="padding: 8px;width: 130px;" />
</form>

</div>


<?php /*?><div class="component"> @include('include.table') </div><?php */?>

<div class="component"> 
@if(count($data) > 0)
    <a class="excelDownload" href="{{Request::root()}}/admin/downloadTrainer{{ $queryString }}"><span></span>Download Excel Sheet</a>
    <div class="tableRows" style="margin:15px;">
        <table width="100%" class="trainerTable" cellspacing="0">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>Name</th>
                    <th width="150">Registration Level</th>
                    <th width="120">Expiry</th>
                    <th width="120">Status</th>
                    <th width="160">Action</th>
                </tr>
            </thead>
            <tbody>
            	
                @foreach($data as $value)
                    <tr>
                        <td style="font-size:11px;">{{ $value['reps_id'] }}</td>
                        <td>{{ $value['first_name']." ".$value['last_name'] }}</td>
                        <?php
                            $cats_temp = $value['levelOfCats']; // implode(", ", $value['levelOfCats']);

                            $cats = [];

                            foreach ($cats_temp as $item) {
                                if (! in_array(trim($item), $cats)) {
                                    $cats[] = $item;
                                }
                            }

                        ?>
                        <td style="font-size:11px;">{{ implode(", ", $cats) }}</td>
                        <td>{{ $value['expiry_date'] }}</td>
                        <td>{{ $value['status_id'] }}</td>
                        <td>
                            <a class="toggler" data-id="{{ $value['id'] }}" href="#">
                               <span class="xxx {{ (isset($value['active']) && $value['active'] == 1 ? 'active' : 'deactive') }}"></span>
                            </a>
                            <a href="{{Request::root()}}/admin/{{$edit}}/update/{{$value['id']}}"><span class="edit"></span></a>
                            <a class="del-trainer" href="{{Request::root()}}/admin/{{$edit}}/delete/{{$value['id']}}"><span class="delete"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator clearfix"> {!!$paginator!!} </div>
@else
    <h5 class="noRecords">There are no records to manage</h5>
@endif 
</div>

<style>
.excelDownload {
	margin:15px;
	color:#333333;
	font-size:14px;
}
.excelDownload span {
	display: block;
	float: left;
	width: 26px;
	height: 28px;
	background: url('/../img/admin/excel_icon.png') no-repeat;
	margin-left: 15px;
	margin-top: -7px;	
}

</style>
@stop 


@section('customScripts')
    $(".del-trainer").click(function() {
        if (!confirm("Are you sure you want to delete the trainer?")) {
            return false;
        }
    });
    $(".toggler").click(function() {
        var trainer = $(this).data('id');
        var url = '{{ URL::action('TrainerController@activateDeactivate') }}/' + trainer;
        var content = $(this);
        
        $.ajax({url:url,success:function(result) {
            if (result.hasOwnProperty('trainer_status')) {
                if (result.trainer_status == false) {
                    $(".xxx", content).addClass('deactive').removeClass('active');
                } else if (result.trainer_status) {
                    $(".xxx", content).addClass('active').removeClass('deactive');
                }
            }
        }});
        
        return false;
    });
    $(document).ready(function() {
        $('#selectBox').on('change', function() {
                $('.hiddenParams').val('');
                $('#'+ $('#selectBox option:selected').attr('class')).val($(this).val());
        });
    });
@stop 