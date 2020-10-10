<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="app-name" content="{{ config('app.name') }}">
    <meta name="theme-color" content="#00b4a4"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon.ico') }}">

    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        {{ config('app.name') }}
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/tailwind.css', 'assets') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css', 'assets') }}">
    @stack('css')
</head>
<body>
<div class="font-sans text-gray-900 antialiased auth-layout">
    <x-auth.card>
        <x-slot name="logo">
            <x-common.logo/>
        </x-slot>

        <x-auth.errors/>

        @if (session('status'))
            <div class="bg-success-100 border border-success-400 text-success-700 px-4 py-3 rounded relative mb-4"
                 role="alert">
                <span class="block sm:inline"> {{ session('status') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"/>
            </div>
        @endif

        {{ $slot }}
    </x-auth.card>
</div>
</body>
</html>
