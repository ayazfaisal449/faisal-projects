
    @if(count($blogs) > 0)
        <div style="margin:15px;">
            <div class="tableHeader">
                <ul>
                    <li>
                        Title
                    </li>
                    <li>
                        Action
                    </li>
                </ul>
            </div>
            <div class="tableRows">
                <ul>
                    @foreach($blogs as $key => $value) 
                        <li style="height:40px;">
                                <span class="sort">{{$value->title}}</span>
                                
                                <div class="action" style="float: right;">
                                    <a href="{{Request::root()}}/admin/blog/update/{{$value->id}}">
                                        <span class="edit"></span>
                                    </a>
                                    <a href="{{Request::root()}}/admin/blog/delete/{{$value->id}}">
                                        <span class="delete-course"></span>
                                    </a>
                                </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <h5 class="noRecords">There are no records to manage</h5>
    @endif
