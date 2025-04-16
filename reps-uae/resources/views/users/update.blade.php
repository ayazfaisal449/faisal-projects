@extends('layouts.admin')

@section('content')
<style>
    form.registration .regLevelCheckBox {
        border-bottom:0px;
        margin: 5px 0;
    }
    form.registration .regLevelCheckBox label {
        padding-left:0px;
    }
    span, div, h1, h2, h3, a, p, input, select {
        font-family: "OpenSans-Regular" !important;
    }
    div.tab_panel {
        margin-top:12px;
    }
    div.tab_panel .tab_label {
        background-color:#D4D4D4;
        color:white;
        border-top:1px solid #6B6B6B;
        margin-left:8px;
        padding:14px 40px;
        font-weight:normal;
        font-size:14px;
        display:inline-block;
    }
    div.sub-tab_panel {
        border-bottom:1px solid #D3D3D3;
        margin:0px 14px;
    }
    div.sub-tab_panel .tab_label {
        display:inline-block;
        font-size:14px;
        padding:12px 24px 12px 24px;
        margin-bottom:6px;
        border-left:1px solid #D3D3D3;
        font-weight:bold;
        color:#D3D3D3;
    }
    div.sub-tab_panel .tab_label a {
        color:#D3D3D3;
    }
    div.sub-tab_panel .tab_label a:hover {
        color:#32A543;
    }
    div.sub-tab_panel .tab_label:first-child {
        border-left:0px;
        padding-left:0px;
    }
    div.sub-tab_panel .tab_active {
        color:#32A543;
    }
    .tab_label a {
        color:white;
    }
    .tab_label a:hover {
        color:#222;
    }
    div.tab_panel .tab_label:first-child {
        margin-left:30px;
    }
    div.tab_panel .tab_active {
        background-color:white;
        color:#878787;
        border-top:1px solid #D4D4D4;
        font-family:"OpenSans-Bold" !important;
    }
    div.the_form_content {
        background-color:white;
        padding:12px;
    }
    .the_form_content .inputWrapper .label,
    .the_form_content .inputWrapper .label label {
        padding-left:0px;
        padding-right:0px;
        color:#878787;
    }
    .the_form_content select {
        color:#878787;
    }
    .the_form_content form.registration .inputWrapper .label .error span.required {
        margin: 10px 6px;
        font-weight:bold;
        color:red;
    }
    .the_form_content input[type="text"], 
    .the_form_content input[type="password"], 
    .the_form_content input[type="date"], 
    .the_form_content input[type="datetime"], 
    .the_form_content input[type="datetime-local"], 
    .the_form_content input[type="month"], 
    .the_form_content input[type="week"], 
    .the_form_content input[type="email"], 
    .the_form_content input[type="number"], 
    .the_form_content input[type="search"], 
    .the_form_content input[type="tel"], 
    .the_form_content input[type="time"], 
    .the_form_content input[type="url"], 
    .the_form_content textarea,
    .the_form_content select {
        -webkit-border-radius:0 !important;
        -moz-border-radius:0 !important;
        border-radius:0 !important;
    }
    .the_form_content form.registration label .upload {
        background: url('/../img/upload4.png?1396939870') no-repeat;
    }
    .the_form_content .pnl-border-top {
        border-top:1px solid #EDEDED;
        padding-top:20px;
        margin-top:30px;
    }
    .the_form_content .admin-button {
        height:42px;
        border:1px solid #CCCCCC;
        background:transparent url('/../img/admin/btn-bg.png') repeat center center;
        padding-left:40px;
        padding-right:40px;
        font-size:16px;
        color:#525252;
    }
    .addForm {
        padding:5px;
    }
    .user-img-prev {
        height:80px;
    }
    form.registration label .upload {
    background: url('/../img/upload.png?1396939870');
    width:401px;
    height:42px;
    }
    .itm-qualification {
        padding:14px;
    }
    .det-qualification {
        color:#777777;
    }
    .det-qualification .info {
        margin-bottom:20px;
    }
    .det-qualification .info span {
        display:inline-block;
        color:black;
        padding-top:12px;
    }
    .det-certs img {
        margin:4px;
        float:left;
    }
    .det-certs a.filecont {
        margin:4px;
        float:left;
        display:block;
        text-align:center;
    }
    .subnotify {
        padding:15px 15px 0px 15px;
        color:red;
        font-size:13px;
    }
    div.renewalDetails {
        line-height:26px;
        font-weight:bold;
    }
    div.renewalDetails a {
        text-decoration:underline;
    }
    div.renewalDetails span {
        color:#5e5e5e;
        font-size:13px;
        font-weight:normal;
    }
</style>
    @include('include.userNotification')

    <div class="tools">
        @if ($editForm == 'workexperience')
            @include('include.updateFormWorkExperience')
        @elseif ($editForm == 'qualification')
            @include('include.updateFormQualifications')
        @elseif ($editForm == 'qualification_add')
            @include('include.updateFormAddQualifications')
        @elseif ($editForm == 'comment')
            @include('include.updateFormComment')
        @else
            @include('include.updateForm')
        @endif
        
        @if (isset($showme)) 
            @include('include.deleteForm')	
        @endif
        <br /><br /><br /><br /><br /><br /><br /><br />
    </div>
@stop


@section('customScripts') 
    $(function() {
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-100Y",
            maxDate: "+0D",
            dateFormat:'yy-mm-dd',
            yearRange: "-100:+0D",
            showMonthAfterYear:true
        });
        $("#expiry_date").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-1Y",
            dateFormat:'yy-mm-dd',
            showMonthAfterYear:true
        });
        $("#date_completed").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-100Y",
            maxDate: "+0D",
            dateFormat:'yy-mm-dd',
            yearRange: "-100:+0D",
            showMonthAfterYear:true
        });
    });
	
	$(document).ready(function(){
		$("input[type=file]").change(function() { 
			$('.filename.' + $(this).attr('id')).empty();
			var files = $(this)[0].files;
			for (var i = 0; i < files.length; i++) {
				var $p = $("<p></p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
			}
		});
	});
@stop