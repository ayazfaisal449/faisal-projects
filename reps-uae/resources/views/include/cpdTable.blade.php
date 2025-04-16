    <div class="tableHeader">
        <ul>
            @foreach($required as $value)
                <li>{{$value}}</li>
            @endforeach
        </ul>
    </div>
    <div class="tableRows">
        <ul>
            @foreach($data as $value) 
                
                <li>
        <span class="Logo"><img src="{{Request::root()}}/images/courseprovider/{{$value[0]}}" height="80" width="80"/>
        </span>            
                
              <span class="Name"> <a href="{{Request::root()}}/course/cpd-courses/{{ $value[3]}}/{{ $value[4]}}"><b>{{$value[1]}}</b></a>:</span>
               <span class="Details"> {{$value[2]}} </span>
        </li>
                
            @endforeach
        </ul>
    </div>
    <div class="paginator clearfix">
        {{$paginator}}
    </div>
