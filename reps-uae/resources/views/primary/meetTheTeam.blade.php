@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row "> 
            <div class="large-12 columns">
                <h1 class="color-green">Meet The Team</h1>
                <p>Meet the team behind REPs UAE</p>
            </div>
        </div>
    </div>

    <div class="row team25">
        <style>
            .teamMember .teamMemberPic .teamtitle01 {
  margin: 0 auto;
  padding: .7rem 0;
  width: 178px;
  height: auto;
  position: relative;
  top: -2rem;
  text-align: center;
  font-size: .8rem;
  color: #fff;
  /* background: url('/../img/team-member-name-bg.png?1445427513') no-repeat 0 0; */
  box-sizing: border-box;
  font-family: "OpenSans-Regular";
  font-size: 14px;
}
.teamMember .teamMemberPic p {
    margin: 0;
    background: #32a543;
    padding: 7px 1px 3px;
    border-radius: 5px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    height: auto;

}
.teamMember .teamMemberPic p:last-child {
    background: #2c8f3a;
    border-top: 0;
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
    padding-top: 3px;
    padding-bottom: 9px;
}
@media(max-width: 600px){

  .teamMember .teamMemberPic p:last-child {
margin-top: -1px !important;
}
}
@media(max-width: 800px){
  .row.team25 {
    padding: 0 2% !important;

}
}
        </style>
          @foreach($team as $dat)
        <div class="teamMember clearfix">

            <div class="teamMemberPic">
                
                 <img src="/{!!$dat->image !!}">
                <div class="teamtitle01">
                    <p>{!!$dat->name!!}</p>

                   <p>{!!$dat->designation!!}</p>
                </div>
            </div>
            <div class="teamMemberDesc">
                {!!$dat->description!!}
            </div>
        </div>

    @endforeach
        </div>

   @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
