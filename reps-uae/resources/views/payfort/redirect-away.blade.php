@extends('layouts.primary')

@section('content')

    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Redirecting..</h1>

                <form method="post" action="https://repsuae.volution.fit/payfort/process/" id="form1" name="form1" style="display:none;">
                    @foreach($response as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#form1').submit();
        });
    </script>
@stop
