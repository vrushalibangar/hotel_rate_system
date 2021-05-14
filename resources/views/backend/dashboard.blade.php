@extends('backend.layout.app')

@section('content')

    <div class="w3-main admin_main_content" style="margin-left:250px">
        <div class="w3-teal">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>{{ __('Dashboard') }}</h1>
            </div>
        </div>

        <div class="w3-container">
            <h2>{{ __('Dashboard Content') }}</h2>
        </div>

    </div>

@endsection