
    
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
                    @foreach($data as $dat) 
                  

                        <li style="height:40px;">
                            <!-- <img src="/{{ $dat->image }}" style="max-height: 25px; float: left;"> -->
                          {{$dat->name}}
                            

                               <!--  <a href="{{Request::root()}}/admin/partner/update/{{$dat->id}}" style="float: right;">{{$dat->id}}</a> -->
                                <div class="action" style="float: right;">

                                   
                                    <a href="{{Request::root()}}/admin/team/update/{{$dat->id}}">
                                        <span class="edit"></span>
                                    </a>
                                    <a href="{{Request::root()}}/admin/team/destroy/{{$dat->id}}">
                                        <span class="delete"></span>
                                    </a>
                                    
                                    
                                    
                                </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    
    
