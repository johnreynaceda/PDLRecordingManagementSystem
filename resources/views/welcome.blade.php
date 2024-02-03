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
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased relative bg-gradient-to-b from-black  to-main overflow">
    <img src="{{ asset('images/camouflage.jpg') }}"
        class="absolute left-0 top-0 bottom-0 w-full h-full object-cover opacity-5" alt="">
    <section class="relative overflow-hidden ">

        <div class="relative w-full">
            <div class="relative flex flex-col max-w-7xl w-full px-5 py-3 mx-auto lg:px-16 md:flex-row md:items-center md:justify-between md:px-6"
                x-data="{ open: false }">
                <div class="flex flex-row items-center justify-between text-sm text-black lg:justify-start">
                    <a href="/">
                        <div class="bjmp flex space-x-3 items-center">
                            <img src="{{ asset('images/bjmp_logo.png') }}" class="h-14" alt="">
                            <div class="">
                                <p class="font-extrabold text-lg font-barlow text-white">BJMP</p>
                                <p class=" leading-[.50rem] font-medium text-gray-300 text-xs">PDL- Carpeta Management
                                    Database
                                    System</p>
                            </div>
                        </div>
                    </a><button @click="open = !open"
                        class="items-center justify-center focus:outline-none inline-flex focus:text-white hover:text-main md:hidden p-2 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 12h16M4 18h16" :class="{ 'hidden': open, 'inline-flex': !open }"
                                class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            </path>
                            <path d="M6 18L18 6M6 6l12 12" :class="{ 'hidden': !open, 'inline-flex': open }"
                                class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{ 'flex': open, 'hidden': !open }"
                    class="flex-col items-center flex-grow hidden md:flex md:flex-row md:justify-end md:pb-0 md:space-x-6">
                    <a class="py-2 text-sm font-medium text-white hover:text-gray-500" href="#_">Home</a>
                    <a class="py-2 text-sm font-medium text-white hover:text-gray-500" href="#_">About Us</a>
                </nav>
            </div>
        </div>
    </section>
    <section class="relative flex items-center w-full  overflow-hidden">
        <img src="{{ asset('images/bjmp_logo.png') }}"
            class="absolute object-cover 2xl:-right-24 -bottom-20 2xl:h-[35rem] h-96 opacity-5 z-10 " alt="">
        <div class="relative z-50 items-center w-full px-5 py-24 mx-auto lg:px-16 lg:py-40 max-w-7xl md:px-12">
            <div class="relative flex-col items-start m-auto align-middle">
                <div class="grid grid-cols-1 gap-6 lg:gap-24 lg:grid-cols-2">
                    <div class="relative items-center gap-12 m-auto lg:inline-flex">
                        <div class="max-w-xl text-center lg:text-left">
                            <div>
                                <p class="text-3xl font-medium md:text-6xl text-slate-900">
                                    <span class="text-white font-barlow font-bold ">"Changing lives, Building a Safer
                                        Nation".</span>
                                </p>
                                <p class="mt-4  flex space-x-3 tracking-tight text-slate-200 ">
                                    <x-button label="#Mandate" sm rounded
                                        class="font-semibold text-white  hover:text-main" />
                                    <x-button label="#Mission" sm rounded
                                        class="font-semibold text-white  hover:text-main" />
                                    <x-button label="#Vision" sm rounded
                                        class="font-semibold text-white  hover:text-main" />
                                    <x-button label="#Core Values" sm rounded
                                        class="font-semibold text-white  hover:text-main" />
                                </p>
                            </div>
                            <div class="flex flex-col items-center gap-3 mt-10 lg:flex-row">

                                <x-button label="Get Started" href="{{ route('login') }}" right-icon="arrow-right"
                                    class="text-white hover:text-main font-semibold" rounded />

                            </div>

                        </div>
                    </div>
                    <div class="block
                                    w-full relative mt-12 lg:mt-0">
                        <div class="relative w-full justify-center flex">
                            <img src="{{ asset('images/jailplan.png') }}" class="object-cover h-96" alt="">
                            <div
                                class="absolute w-full left-0 bottom-1 bg-gradient-to-tl from-main to-transparent rounded-xl">
                                <div class="flex justify-center">
                                    <span class="font-bold text-4xl text-center uppercase text-white font-barlow">The
                                        future is here</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white bg-opacity-90">
        <section>
            <div class="relative items-center w-full px-5 py-20 mx-auto md:px-12 lg:px-20 max-w-7xl">
                <div class="div">
                    <h1 class="font-bold text-4xl text-red-500">KEY POINTS JAIL PLAN 2024 PERSPECTIVES</h1>
                    <div class="w-20 h-1 bg-gray-600 rounded-br-xl"></div>
                </div>
                <div class="grid w-full grid-cols-1 mx-auto mt-10 lg:grid-cols-4">
                    <div class="max-w-md p-6 mx-auto">
                        <div class="flex items-center justify-center w-12 h-12 text-main bg-yellow-200 rounded-xl">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path d="M4 6a3 3 0 010-6h7a3 3 0 110 6H9V3.5a2.5 2.5 0 00-5 0V6z" fill="currentColor">
                                </path>
                                <path
                                    d="M6.5 2A1.5 1.5 0 005 3.5v4.55a2.5 2.5 0 00-2 2.45A4.5 4.5 0 007.5 15H8a5 5 0 005-5v-.853A2.147 2.147 0 0010.853 7H8V3.5A1.5 1.5 0 006.5 2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                            RESOURCE MANAGEMENT
                        </p>
                        <p class="mt-3 text-sm text-gray-500">
                            <li class="text-sm text-gray-500">
                                Optimize logistical and financial adequacy.
                            </li>
                        </p>
                    </div>
                    <div class="max-w-md p-6 mx-auto">
                        <div class="flex items-center justify-center w-12 h-12 text-main bg-green-200 rounded-xl">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path d="M4 6a3 3 0 010-6h7a3 3 0 110 6H9V3.5a2.5 2.5 0 00-5 0V6z" fill="currentColor">
                                </path>
                                <path
                                    d="M6.5 2A1.5 1.5 0 005 3.5v4.55a2.5 2.5 0 00-2 2.45A4.5 4.5 0 007.5 15H8a5 5 0 005-5v-.853A2.147 2.147 0 0010.853 7H8V3.5A1.5 1.5 0 006.5 2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                            LEARNING AND GROWTH
                        </p>
                        <p class="mt-3 text-sm text-gray-500">
                            <li class="text-sm text-gray-500"> Develop highly competent,
                                motivated, and disciplined personnel
                                (Human Capital)</li>

                            <li class="text-sm text-gray-500">Improve technology infrastructure
                                (Information Capital)</li>
                            <li class="text-sm text-gray-500"> Develop a proactive and resilient
                                Organization
                                (Organizational Capital)</li>
                        </p>
                    </div>
                    <div class="max-w-md p-6 mx-auto">
                        <div class="flex items-center justify-center w-12 h-12 text-main bg-red-200 rounded-xl">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path d="M4 6a3 3 0 010-6h7a3 3 0 110 6H9V3.5a2.5 2.5 0 00-5 0V6z" fill="currentColor">
                                </path>
                                <path
                                    d="M6.5 2A1.5 1.5 0 005 3.5v4.55a2.5 2.5 0 00-2 2.45A4.5 4.5 0 007.5 15H8a5 5 0 005-5v-.853A2.147 2.147 0 0010.853 7H8V3.5A1.5 1.5 0 006.5 2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <p class="mt-5 mb-3 text-lg font-bold leading-6 text-main">
                            PROCESS EXCELLENCE
                        </p>
                        <li class="text-sm text-gray-500">Enhanced PDL humane safekeeping
                        </li>
                        <li class="text-sm text-gray-500">
                            Strengthen responsive and holistic PDL
                            welfare and development programs
                        </li>
                    </div>
                    <div class="max-w-md p-6 mx-auto">
                        <div class="flex items-center justify-center w-12 h-12 text-main bg-blue-200 rounded-xl">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"
                                fill="currentColor">
                                <path d="M4 6a3 3 0 010-6h7a3 3 0 110 6H9V3.5a2.5 2.5 0 00-5 0V6z" fill="currentColor">
                                </path>
                                <path
                                    d="M6.5 2A1.5 1.5 0 005 3.5v4.55a2.5 2.5 0 00-2 2.45A4.5 4.5 0 007.5 15H8a5 5 0 005-5v-.853A2.147 2.147 0 0010.853 7H8V3.5A1.5 1.5 0 006.5 2z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                            COMMUNITY
                        </p>
                        <p class="mt-3 text-sm text-gray-500">
                            <li class=" text-sm text-gray-500">
                                Empowered released PDL to promote
                                public safety and security
                            </li>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
                <div class="grid items-center grid-cols-1 gap-12 text-left lg:gap-24 md:grid-cols-2 lg:grid-cols-3">
                    <div class="relative items-end gap-12 m-auto lg:inline-flex md:order-first">
                        <div class="mx-auto lg:max-w-7xl">
                            <ul role="list" class="grid grid-cols-2 gap-4 list-none lg:grid-cols-1 lg:gap-6">
                                <li>
                                    <div>
                                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                                            MANDATE
                                        </p>
                                    </div>
                                    <div class="mt-2 text-base text-gray-500">
                                        Republic act 6975 as amended by
                                        RA 9263 and further amended
                                        by RA 9592.
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                                            CORE VALUES
                                        </p>
                                    </div>
                                    <div class="mt-2 text-base text-gray-500">
                                        <ul>
                                            <li>MAKATAO(Respect forhumanity)</li>
                                            <li>MAY INTEGRIDAD(With Integrity)</li>
                                            <li>MATATAG(Resilency)</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-first block w-full  aspect-square lg:mt-0">
                        <img class="object-cover w-full mx-auto  lg:ml-auto" alt="hero"
                            src="{{ asset('images/officer.png') }}">
                    </div>
                    <div class="relative items-center gap-12 m-auto lg:inline-flex md:order-first">
                        <div class="mx-auto lg:max-w-7xl">
                            <ul role="list" class="grid grid-cols-2 gap-4 list-none lg:grid-cols-1 lg:gap-6">
                                <li>
                                    <div>
                                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                                            MISSION
                                        </p>
                                    </div>
                                    <div class="mt-2 text-base text-gray-500">
                                        To provide humane safekeeping and developmental oppurtunities for persons
                                        deprived of Liberty (PDL) in the promotion of public safety.
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <p class="mt-5 text-lg font-bold leading-6 text-main">
                                            VISION
                                        </p>
                                    </div>
                                    <div class="mt-2 text-base text-gray-500">
                                        By 2040, a world-class agency highly capable of providing humane safekeeping and
                                        development oppurtunities for persons deprived of Liberty (PDL).
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <footer class="bg-gradient-to-t from-black  to-main" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="px-5 py-12 mx-auto max-w-7xl lg:py-16 md:px-12 lg:px-20">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="xl:col-span-1">
                    <a href="/"
                        class="text-lg font-bold tracking-tighter transition duration-500 ease-in-out transform text-black tracking-relaxed lg:pr-8">
                    <img src="{{asset('images/bjmp_logo.png')}}" class="h-20" alt="">   
                    </a>
                    <div>
                        <h1 class="font-bold text-xl text-white">BJMP</h1>
                        <span class="text-white text-sm leading-3">PDL - Recording Management System</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8 mt-12 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="font-semibold leading-6 uppercase text-black">
                                Solutions
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Marketing
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Analytics
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Commerce
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Insights
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="font-semibold leading-6 uppercase text-black">
                                Support
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Alpine.js
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        Guides
                                    </a>
                                </li>
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-blue-600">
                                        API Status
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hidden lg:justify-end md:grid md:grid-cols-1">
                        <div class="w-full mt-12 md:mt-0">
                            <div class="mt-8 lg:justify-end xl:mt-0">
                                <h3 class="font-semibold leading-6 uppercase text-black">
                                    Subscribe to our newsletter
                                </h3>
                                <p class="mt-4 text-sm font-light text-gray-500 lg:ml-auto">
                                    The latest news, articles, and resources, sent to your inbox
                                    weekly.
                                </p>
                                <div class="inline-flex items-center gap-2 mt-12 list-none lg:ml-auto">
                                    <form class="flex flex-col items-center justify-center max-w-sm mx-auto"
                                        action="">
                                        <div class="flex flex-col w-full gap-1 mt-3 sm:flex-row">
                                            <input name="email" type="email"
                                                class="block w-full px-4 py-2 text-sm font-medium text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-full font-spline focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600/50 disabled:opacity-50"
                                                placeholder="Enter your email..." required=""><button
                                                type="button"
                                                class="items-center inline-flex  justify-center w-full px-6 py-2.5 text-center text-white duration-200 bg-black border-2 border-black rounded-full nline-flex hover:bg-transparent hover:border-black hover:text-black focus:outline-none lg:w-auto focus-visible:outline-black text-sm focus-visible:ring-black">
                                                <div style="position: relative"></div>
                                                Subscribe<!-- -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true" class="w-4 h-auto ml-2">
                                                    <path fill-rule="evenodd"
                                                        d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 py-12 mx-auto border-t max-w-7xl sm:px-6 md:flex md:items-center md:justify-between lg:px-20">
            <div class="flex justify-center mb-8 space-x-6 md:order-last md:mb-0">
                <span class="inline-flex justify-center w-full gap-3 lg:ml-auto md:justify-start md:w-auto">
                    <a class="w-6 h-6 transition fill-black hover:text-blue-500">
                        <span class="sr-only"> github</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-github" role="img"
                            aria-label="logo github"></ion-icon>
                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-blue-500">
                        <span class="sr-only"> twitter</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-twitter" role="img"
                            aria-label="logo twitter"></ion-icon>
                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-blue-500">
                        <span class="sr-only">Instagram</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-instagram" role="img"
                            aria-label="logo instagram"></ion-icon>
                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-blue-500">
                        <span class="sr-only">Linkedin</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-linkedin" role="img"
                            aria-label="logo linkedin"></ion-icon>
                    </a>
                </span>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <span class="mt-2 text-sm font-light text-gray-500">
                    Copyright © 2020 - 2021
                    <a href="#_" class="mx-2 text-wickedblue hover:text-gray-500"
                        rel="noopener noreferrer">@unwrappedHQ</a>. Since 2020
                </span>
            </div>
        </div>
    </footer>
    @stack('modals')
</body>

</html>
