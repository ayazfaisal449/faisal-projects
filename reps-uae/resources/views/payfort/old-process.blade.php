@extends('layouts.primary')

@section('content')

    @include('include.subNav')

    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Initializing Payfort Payment</h1>
                 <h1 class="color-green">Our Payment Gateway is under maintenance.</h1>
                @if(1 == 2)
                <form method="post" action="https://secure.payfort.com/ncol/test/orderstandard.asp" id="form1" name="form1" style="display:none;">
                @else
               	<form method="post" action="https://secure.payfort.com/ncol/prod/orderstandard.asp" id="form1" name="form1" style="display:none;">
                @endif

                    <!-- general parameters: see General Payment Parameters -->
                    <label for="AMOUNT">AMOUNT: </label><input type="text" name="AMOUNT" id="AMOUNT" value="{{ $AMOUNT }}"><br>
                    <label for="COM">COM: </label><input type="text" name="COM" id="COM" value="{{ $COM }}"><br>
                    <label for="CURRENCY">CURRENCY: </label><input type="text" name="CURRENCY" id="CURRENCY" value="{{ $CURRENCY }}"><br>
                    <label for="EMAIL">EMAIL: </label><input type="text" name="EMAIL" id="EMAIL" value="{{ $EMAIL }}"><br>
                    <label for="LANGUAGE">LANGUAGE: </label><input type="text" name="LANGUAGE" id="LANGUAGE" value="{{ $LANGUAGE }}"><br>
                    <label for="ORDERID">ORDERID: </label><input type="text" name="ORDERID" id="ORDERID" value="{{ $ORDERID }}"><br>
                    <label for="OWNERTELNO">OWNERTELNO: </label><input type="text" name="OWNERTELNO" id="OWNERTELNO" value="{{ $OWNERTELNO }}"><br>
                    <label for="PSPID">PSPID: </label><input type="text" name="PSPID" id="PSPID" value="{{ $PSPID }}"><br>
                    <!-- <input type="text" name="TP" value=""> -->
                    
                    <label for="PSPID">SHASIGN: </label><input type="text" name="SHASIGN" id="SHASIGN" value="{{ $SHASIGN }}"><br>
                    <!-- <input type="hidden" name="SHASIGN" value="8609707C048BDAF9CF8430A026A663FE572EFB97"> -->
                    <input type="submit" value="Submit" id="submit2" name="SUBMIT2">
                </form>
            </div>
        </div>
    </div>

    <div class="swril cpdProviders"></div>
    <script>
    $(document).ready(function() {
        $('#form1').submit();
    });
</script>
@stop
