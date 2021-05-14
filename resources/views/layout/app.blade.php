<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('public/assets/css/mdb.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/assets/css/custom_style.css')}}" />
</head>
<body>

@include('includes.header')

@yield('content')

@include('includes.footer')
<!-- MDB -->
<script type="text/javascript" src="{{asset('public/assets/js/mdb.min.js')}}"></script>

@yield('script')

</body>
</html>
