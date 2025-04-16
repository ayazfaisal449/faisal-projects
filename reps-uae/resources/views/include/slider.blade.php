
    @if(count($slider) > 0)
        <div style="margin:15px;">
            <div class="tableHeader">
                <ul>
                    <li>
                        Name
                    </li>
                    <li>
                        Action
                    </li>
                </ul>
            </div>
            <div class="tableRows">
                <ul>
                    @foreach($slider as $key => $value) 
                        <li>
                            <a href="{{Request::root()}}/admin/slider/update/{{$value['id']}}">{{$value['text']}}</a>
                            <div class="action">

                                @if(isset($value['is_active']) && $value['is_active'] == 1)
                                    <a href="{{Request::root()}}/admin/slider/changeStatus/{{$value['id']}}/0">
                                       <span class="active"></span>
                                    </a>
                                @else
                                    <a href="{{Request::root()}}/admin/slider/changeStatus/{{$value['id']}}/1">
                                      <span class="deactive"></span>
                                    </a>	
                                @endif
                                <a href="{{Request::root()}}/admin/slider/update/{{$value['id']}}">
                                    <span class="edit"></span>
                                </a>
                                <a href="{{Request::root()}}/admin/slider/delete/{{$value['id']}}">
                                    <span class="delete"></span>
                                </a>
                                
                                <span class="sort">Order: {{$value['sort_order']}}</span>
                                
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <h5 class="noRecords">There are no records to manage</h5>
    @endif