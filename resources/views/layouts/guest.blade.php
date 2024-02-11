<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @wireUiScripts
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-900 antialiased relative bg-main">
    <img src="{{ asset('images/bjmp_logo.png') }}" class=" bottom-0 -left-72 fixed opacity-10 ">
    <img src="{{ asset('images/jailplan.png') }}" class="h-[60rem] bottom-0 -right-72 fixed opacity-10 ">
    <img src="{{ asset('images/camouflage.jpg') }}"
        class="fixed top-0 bottom-0 opacity-10 object-cover h-full left-0 w-full" alt="">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        {{-- <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div> --}}

        <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden relative bg-white sm:rounded-lg">
            <h1 class="text-2xl text-center pt-3 font-bold font-barlow text-main">PDL-Carpeta Management System</h1>
            <div class="mt-10">
                {{ $slot }}
            </div>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
