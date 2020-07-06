<!DOCTYPE html>
<html lang="{{ getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="app-name" content="{{ config('app.name') }}">

    <title>
        {{ config('app.name') }}
    </title>

    <meta name="theme-color" content="#00b4a4"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon.ico') }}"/>

    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--Fonts--}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ back_mix('css/app.css') }}"/>
    @stack('css')
</head>
<body class="text-secondary antialiased">
<noscript>You need to enable JavaScript to run this app.</noscript>

@inertia

@unlessenv('production')
@routes
@endenv

{{--Scripts--}}
{{--<script src="{{ back_mix('js/manifest.js') }}"></script>--}}
{{--<script src="{{ back_mix('js/vendor.js') }}"></script>--}}
<script src="{{ back_mix('js/app.js') }}"></script>
@stack('js')

</body>
</html>
