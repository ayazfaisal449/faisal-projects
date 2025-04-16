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
                    <a href="{{Request::root()}}/{{$edit}}/admin/update/{{$value[1]}}">{{$value[0]}}</a>
                    <div class="action">
                        <a href="{{Request::root()}}/{{$edit}}/admin/update/{{$value[1]}}">
                            <span class="edit"></span>
                        </a>
                        <a href="{{Request::root()}}/{{$edit}}/admin/delete/{{$value[1]}}">
                            <span class="delete"></span>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="paginator clearfix">
        {{$paginator}}
    </div>
