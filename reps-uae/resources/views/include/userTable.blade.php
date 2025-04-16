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
                    <a href="{{Request::root()}}/admin/{{$edit}}/update/{{$value[1]}}">{{$value[0]}}</a>
                    @if(isset(Sentry::getUser()->id) == 1)
                    <div class="action">
                        <a href="{{Request::root()}}/admin/{{$edit}}/update/{{$value[1]}}">
                            <span class="edit"></span>
                        </a>
                        <a href="{{Request::root()}}/admin/{{$edit}}/delete/{{$value[1]}}">
                            <span class="delete"></span>
                        </a>
                        <a href="{{Request::root()}}/admin/{{$edit}}/mailchimp/{{$value[1]}}">
                           Mailchimp
                        </a>
                        @if(isset($value[2]) && $value[2] == 1)
                            <a href="{{Request::root()}}/admin/{{$edit}}/changeStatus/{{$value[1]}}/0">
                               Active
                            </a>
                        @else
                             <a href="{{Request::root()}}/admin/{{$edit}}/changeStatus/{{$value[1]}}/1">
                               Dactive
                            </a>    
                        @endif
                    </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="paginator clearfix">
        {{$paginator}}
    </div>
