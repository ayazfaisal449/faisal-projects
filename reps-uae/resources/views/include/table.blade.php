    @if(count($data) > 0)
        <div style="margin:15px;">
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
                            <div class="action">
                                @if(isset($value[2]) && $value[2] == 1)
                                    <a href="{{Request::root()}}/admin/{{$edit}}/changeStatus/{{$value[1]}}/0">
                                       <span class="active"></span>
                                    </a>
                                @else
                                    <a href="{{Request::root()}}/admin/{{$edit}}/changeStatus/{{$value[1]}}/1">
                                      <span class="deactive"></span>
                                    </a>	
                                @endif
                                <a href="{{Request::root()}}/admin/{{$edit}}/update/{{$value[1]}}">
                                    <span class="edit"></span>
                                </a>
                                <a href="{{Request::root()}}/admin/{{$edit}}/delete/{{$value[1]}}">
                                    <span class="delete"></span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="paginator clearfix">
            {!!$paginator!!}
        </div>
    @else
        <h5 class="noRecords">There are no records to manage</h5>
    @endif