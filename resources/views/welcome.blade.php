@extends('layouts.layoutForLoginRegistration')

@section('title', '| Welcome')
@section('content')
@guest
    <body onload="loadFunc()">
    <div class="w3-container w3-content" style="text-align: center; margin: 10% auto" id="guest">
        <h1 style="font-size: 700%"><i class="fa fa-paw"></i> IPlanProject!</h1>
        <div style="font-size: 700%; font-style: italic" class="panel-heading">Добро пожаловать!</div>
    </div>
    </body>
    @else
        <body onload="loadFuncHome()">
        <div class="w3-container w3-content" style="text-align: center; margin: 10% auto">
            <h1 style="font-size: 700%"><i class="fa fa-paw"></i> IPlanProject!</h1>
            <div style="font-size: 700%; font-style: italic" class="panel-heading">Добро пожаловать!</div>
        </div>
    @endguest
    <script>
        function loadFunc() {
            setTimeout(function tick() {
                location.href='{{ route('login') }}'
            }, 2000);
        }
        function loadFuncHome() {
            setTimeout(function tick() {
                location.href='{{ route('home') }}'
            }, 2000);
        }
    </script>
@endsection
