
        <h3>Update {{$subFormTitle}} {{$errors->first('groups', ':message')}}</h3>
    
        @for($i=0;$i<count($subForm);$i++)
            @if ($i % 4 == 0)
                <div class="row">
            @endif
            
             <div class="large-{{ ($i + 1) == count($subForm) ? (4 - ($i % 4)) * 3 : 3 }} columns">
                @if($subForm[$i][1] == 'checkbox')
                    {{Form::$subForm[$i][1]($subForm[$i][0],$subForm[$i][4],$subForm[$i][5],array('id'=>$subForm[$i][2]));}}
                @else 
                     {{Form::$subForm[$i][1]($subForm[$i][0],$subForm[$i][4],array('id'=>$subForm[$i][2]));}}
                @endif
                {{Form::label($subForm[$i][2], $subForm[$i][2]);}}
             </div>
             
             @if (count($subForm) == $i + 1 || ($i + 1) % 4 == 0)
                </div>
            @endif
             
        @endfor

   