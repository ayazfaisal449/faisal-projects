
    
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
                           
                           
                          {{$dat->page}}
                            

                               <!--  <a href="{{Request::root()}}/admin/partner/update/{{$dat->id}}" style="float: right;">{{$dat->id}}</a> -->
                                <div class="action" style="float: right;">

                                   
                                    <a href="{{Request::root()}}/admin/setting/update/{{$dat->id}}">
                                        <span class="edit"></span>
                                    </a>
                                    <!-- <a href="{{Request::root()}}/admin/setting/destroy/{{$dat->id}}">
                                        <span class="delete"></span>
                                    </a> -->
                                    
                                    
                                    
                                </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    
    
