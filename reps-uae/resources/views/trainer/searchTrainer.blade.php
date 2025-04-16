@extends('layouts.primary')
@section('content')
<head>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 -->
</head>
<style>
@media (max-width: 485px) {
    .searchContent .wrapper .searchTrainerResults h5 {
        font-size: 12px;
        margin-bottom:10px;
    }
}
@media (max-width: 900px) {
    .searchContent .wrapper {
        float: none;
        display: block;
        width: auto;
        margin: 0;
        padding: 0;
        margin-top: 30px;
    }
}
.searchContent .wrapper .searchTrainerResults {
    display:block;
    float:none;
    margin-left:0px;
    padding-left: 140px;
}
</style>
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Member Directory</h1>
                <p>Check that your trainer is an active member of REPs by using this search section.</p>
            </div>
        </div>
    </div>
    
    {!!Form::open(array(
        'url' => Request::root().'/searcht',
        'files' => true, 
        'name' => 'searchTrainer',
        'class' => 'searchTrainer',
        'method' => 'GET'
    ))!!}
    
        <div class="row">
        
            <div class="large-4 medium-4 columns">
                
                {!!Form::label('trainer', 'Name')!!}
                <input type="text" name="trainer" placeholder="Trainer Name" id="search"  />

                
            </div>
            
            <div class="large-4 medium-4 columns">
            
                {!!Form::label('residence', 'City of Residence')!!}
                <input type="text" name="city" placeholder="City of Residence" id="city" />
                
                
            </div>
            
            <div class="large-4 medium-4 columns">

                {!!Form::label('level', 'Category')!!}
                {!!Form::select('level',$levels)!!}
                
            </div>
        
        </div>
        
        <div class="row">
            
            <div class="large-4 medium-4 columns">
                
                {!!Form::label('gender', 'Gender')!!}
                {!!Form::select('gender',$gender)!!}

            </div>
            
            <div class="large-4 medium-4 columns">

                {!!Form::label('nationality_id', 'Nationality')!!}
                {!!Form::select('nationality_id',$nationality , request()->old('nationality_id'))!!}
                
            </div>
            
            <div class="large-4 medium-4 columns">
                <input class="submitBtn searchBtn" type="submit" value="Search" />
            </div>
            
        </div>

        
   {!!Form::close()!!}
    
    @if(isset($search) && count($search) > 0)
        <div class="row">
            <div class="large-12 columns">
                <div class="searchHeader">
                    <h3>Search Results ({!!$record_count!!} record(s) found)</h3>
                    <p>To contact the trainer, please send an email to faisal.ayaz@sigmads.com</p>
                    
                    <table style="undefined;table-layout: fixed; width: 632px">
                        <colgroup>
                        <col style="width: 26px">
                        <col style="width: 302px">
                        <col style="width: 26px">
                        <col style="width: 278px">
                        </colgroup>
                          <tr>
                            <th>A:</th>
                            <th>Personal Trainer</th>
                            <th>F:</th>
                            <th>Pilates Instructor</th>
                          </tr>
                          <tr>
                            <th>B:</th>
                            <th>Gym Instructor</th>
                            <th>G:</th>
                            <th>Pilates Instructor Comprehensive</th>
                          </tr>
                          <tr>
                            <th>C:</th>
                            <th>Group Fitness Instructor</th>
                            <th>H:</th>
                            <th>Aqua Fitness Instructor</th>
                          </tr>
                          <tr>
                            <th>D:</th>
                            <th>Group Fitness Instructor Freestyle</th>
                            <th>I:</th>
                            <th>Children's Fitness Instructor</th>
                          </tr>
                          <tr>
                            <th>E:</th>
                            <th>Yoga Instructor</th>
                            <th>J:</th>
                            <th>Advanced Exercise Specialist</th>
                          </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <div class="searchContent clearfix">
                    <!--loop around the search results -->
                    @foreach($search as $trainer)
                        <div class="wrapper clearfix">
                            <img src="{!!REquest::root()!!}/trainer/{!!$trainer[0]!!}/photo/{!!$trainer[4]!!}" alt="{!!$trainer[1]!!}" />
                            <div class="searchTrainerResults">
                                <h5>{!!$trainer[1]!!}</h5>
                                <span>REPS Id: <b>{!!strtoupper($trainer[8])!!}</b></span>
                                <span>Category: <b>{!! implode(",&nbsp;&nbsp;", $trainer[7]) !!}</b></span>
                                <span>Nationality: <b>{!!$trainer[3]!!}</b></span>
                                <span>City: <b>{!! strtoupper($trainer[9]) !!}</b></span>
                                <span>Status: <b>{!!$trainer[5]!!}</b></span>
                                <span>Expiry Date: <b>{!!$trainer[6]!!}</b></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        @if(isset($paginator) && !empty($paginator))
            <div class="row">
                <div class="large-12 columns">
                    <div class="paginator">
                        {!!$paginator!!}
                    </div>
                </div>
            </div>
        @endif
        
    @endif
    
    @include('include.subFooter')
	 
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function(){
 
   
     $( "#search" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo  Request::root().'/searchtt'; ?>",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
       // console.log(ui.item.name);
           // Set selection
           $('#search').val(ui.item.label + ' ' + ui.item.label1); // display the selected text
           $('#city').val(ui.item.city);
           $('#level').val(ui.item.registration_category_id); 
           $('#gender').val(ui.item.gender); 
           $('#nationality_id').val(ui.item.nationality_id); 

            // save selected id to input
           return false;
      } 
    });


//      <!--
// $('#search').autocomplete({
//     'source': function(request, response) {
//         $.ajax({
//              url: "<?php //echo  Request::root().'/searcht'; ?>",
//             dataType: 'json',
//             success: function(json) {
                
//                 response($.map(json, function(item) {
//                     return {
//                         label: item['name'],
//                         value: item['category_id']
//                     }
//                 }));
//             }
//         });
//     },
//     'select': function(item) {
//         $('input[name=\'path\']').val(item['label']);
//         $('input[name=\'parent_id\']').val(item['value']);
//     }
// });
//-->
  
 

});
</script>

