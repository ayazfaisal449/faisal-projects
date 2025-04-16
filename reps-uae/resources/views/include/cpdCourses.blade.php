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
                    <b>{{$value[0]}}</b>:&nbsp;
                    {{$value[1]}}
                </li>
                
            @endforeach
        </ul>
    </div>
    <div class="paginator clearfix">
        {{$paginator}}
    </div>
