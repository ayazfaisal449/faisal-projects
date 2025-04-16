
    @if(count($partner) > 0)
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
                    @foreach($partner as $key => $value) 
                        <li style="height:40px;">
                            <img src="/{{ $value['location'] }}" style="max-height: 25px; float: left;">
                            

                                <a href="{{Request::root()}}/admin/partner/update/{{$value['id']}}" style="float: right;">{{$value['text']}}</a>
                                <div class="action" style="float: right;">

                                    @if(isset($value['is_active']) && $value['is_active'] == 1)
                                        <a href="{{Request::root()}}/admin/partner/changeStatus/{{$value['id']}}/0">
                                           <span class="active"></span>
                                        </a>
                                    @else
                                        <a href="{{Request::root()}}/admin/partner/changeStatus/{{$value['id']}}/1">
                                          <span class="deactive"></span>
                                        </a>    
                                    @endif
                                    <a href="{{Request::root()}}/admin/partner/update/{{$value['id']}}">
                                        <span class="edit"></span>
                                    </a>
                                    <a href="{{Request::root()}}/admin/partner/delete/{{$value['id']}}">
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
