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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @wireUiScripts
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased relative bg-main">
    <img src="{{ asset('images/bjmp_logo.png') }}" class=" bottom-0 -left-72 fixed opacity-10 ">
    <img src="{{ asset('images/jailplan.png') }}" class="h-[60rem] bottom-0 -right-72 fixed opacity-10 ">
    <img src="{{ asset('images/camouflage.jpg') }}"
        class="fixed top-0 bottom-0 opacity-10 object-cover h-full left-0 w-full" alt="">
    <div class=" bg-white sticky top-0 z-30  shadow-xl border-b">
        <livewire:navbar />
    </div>
    <div class="mx-auto max-w-7xl pt-12 pb-8 relative">
        <header class="text-white text-2xl uppercase font-bold">
            @yield('title')
        </header>
        <div class=" text-5xl font-dancing text-white font-extrabold text-center">
            Changing Lives, Building a Safer Nation
        </div>
        <div class="mt-12">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
    <x-dialog z-index="z-50" blur="md" align="center" />
</body>

</html>
