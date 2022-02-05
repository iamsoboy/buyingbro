@extends('layouts.shopmenu')

@section('title', 'Checkout')

@section('extra_script')
    <link rel="stylesheet" href="{{asset('css/adyen.css')}}">
    <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/4.1.0/adyen.js"
            integrity="sha384-3tEepwhhMcyxgIbL3HBe3I59BpSMNyKoNrbKWARYH1tJ7K7K6NdTDqOltKlwiVsH"
            crossorigin="anonymous"></script>

    <link rel="stylesheet"
          href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/4.1.0/adyen.css"
          integrity="sha384-+CPzBNZVkBXu4uXDECnVuVQ24Kl8vWrR61UzuuuUj5IBEP//BQ0G0KDNfz2iPcvJ"
          crossorigin="anonymous">
@endsection

@section('content')
    <title>Integration: </title>

    {{-- Hidden divs with data passed from the PHP server
    <div id="clientKey" class="hidden">{{$clientKey}}</div>
    <div id="type" class="hidden">{{$type}}</div>
    <div id="amount" class="hidden">{{$amount}}</div>
    <div id="currency" class="hidden">{{$currency}}--}}



    <div id="payment-page">
        <div class="container">
            <div id="component-container"></div>
            {{--<div id="component-container"></div>--}}
            {{-- The Checkout integration type will be rendered below --}}
            {{-- Drop-in includes styling out-of-the-box, so no additional CSS classes are needed.
            <div class="payment-container">
                <div id={{$type}} class="payment"></div>
            </div>--}}
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/adyenimplementation.js') }}"></script>
@endsection
