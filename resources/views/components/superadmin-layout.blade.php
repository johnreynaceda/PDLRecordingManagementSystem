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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @wireUiScripts
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden bg-gradient-to-tr from-black to-main">
        <img src="{{ asset('images/bjmp_logo.png') }}" class=" bottom-0 -left-72 absolute opacity-10 ">
        <img src="{{ asset('images/jailplan.png') }}" class="h-[60rem] bottom-0 -right-72 absolute opacity-10 ">
        <img src="{{ asset('images/camouflage.jpg') }}"
            class="absolute top-0 bottom-0 opacity-10 object-cover h-full left-0 w-full" alt="">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 relative">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-white bg-opacity-95 border-r">
                    <div class="flex flex-col flex-shrink-0 px-4">
                        <a class="text-lg font-semibold flex space-x-2 items-center justify-center tracking-tighter text-black focus:outline-none focus:ring "
                            href="/">
                            <img src="{{ asset('images/bjmp_logo.png') }}" class="h-14" alt="">
                            <div>
                                <h1 class="font-bold text-lg text-gray-700 font-barlow">BJMP</h1>
                                <h1 class="text-xs leading-3 text-gray-500">PDL-Carpeta Management System</h1>
                            </div>
                        </a>
                        <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col flex-grow mt-5 border-t pt-5">
                        <div class=" flex flex-col justify-center items-center">
                            <div class=" border-2 border-main/50 h-14 w-14 relative overflow-hidden rounded-full">
                                <img src="{{ asset('images/sample.png') }}"
                                    class="absolute h-full top-0 bottom-0 object-cover w-full" alt="">
                            </div>
                            <span class="text-xs mt-2">{{ auth()->user()->email }}</span>

                            <div class="mt-1 flex flex-col">

                                <x-badge label="{{ auth()->user()->user_type }}" rounded flat dark />
                            </div>
                        </div>
                        <nav class="flex-1 mt-10 px-2 ">
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('superadmin.dashboard') ? 'bg-gray-200 text-main scale-95' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                        href="#">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M19.33 5.68L13.06 2.3c-.66-.36-1.46-.36-2.12 0L4.67 5.68c-.46.25-.74.73-.74 1.28 0 .54.28 1.03.74 1.28l6.27 3.38c.33.18.7.27 1.06.27.36 0 .73-.09 1.06-.27l6.27-3.38c.46-.25.74-.73.74-1.28s-.28-1.03-.74-1.28z">
                                            </path>
                                            <path
                                                d="M9.91 12.79L4.07 9.87c-.45-.22-.97-.2-1.39.06-.43.27-.68.72-.68 1.22v5.51c0 .95.53 1.81 1.38 2.24l5.83 2.92a1.442 1.442 0 001.39-.06c.43-.26.68-.72.68-1.22v-5.51c.01-.96-.52-1.82-1.37-2.24zM21.32 9.93c-.43-.26-.95-.29-1.39-.06l-5.83 2.92c-.85.43-1.38 1.28-1.38 2.24v5.51c0 .5.25.96.68 1.22a1.442 1.442 0 001.39.06l5.83-2.92c.85-.43 1.38-1.28 1.38-2.24v-5.51c0-.5-.25-.95-.68-1.22z"
                                                opacity=".4"></path>
                                        </svg>
                                        <span class="ml-4">
                                            Dashboard
                                        </span>
                                    </a>
                                </li>

                            </ul>
                            <div>
                                <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
                                    Management
                                </p>
                                <ul>
                                    <li>
                                        <a class="{{ request()->routeIs('superadmin.jails') ? 'bg-gray-200 text-main scale-95' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="{{ route('superadmin.jails') }}">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M12.5 7.41V22H4.08c-1.16 0-2.11-.93-2.11-2.07V5.09c0-2.62 1.96-3.81 4.35-2.64l4.43 2.19c.96.47 1.75 1.72 1.75 2.77z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M8.97 9.75H5.5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3.47a.749.749 0 110 1.5zM8.97 13.75H5.5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3.47a.749.749 0 110 1.5z">
                                                </path>
                                                <path
                                                    d="M22 15.05v4.45a2.5 2.5 0 01-2.5 2.5h-7V10.42l.47.1 4.04.9.48.11 2.04.46c.49.1.94.27 1.33.52 0 .01.01.01.01.01.1.07.2.15.29.24.46.46.76 1.13.83 2.11 0 .06.01.12.01.18z"
                                                    opacity=".6"></path>
                                                <path
                                                    d="M12.5 10.42v6c.46.61 1.18 1 2 1 1.39 0 2.51-1.12 2.51-2.5v-3.49l-4.04-.9-.47-.11zM21.99 14.87c-.07-.98-.37-1.65-.83-2.11-.09-.09-.19-.17-.29-.24 0 0-.01 0-.01-.01-.39-.25-.84-.42-1.33-.52l-2.04-.46-.48-.11v3.5a2.5 2.5 0 002.5 2.5A2.5 2.5 0 0022 15.06v-.01c0-.06-.01-.12-.01-.18z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Jail Branches
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('superadmin.pdl') ? 'bg-gray-200 text-main scale-95' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="{{ route('superadmin.pdl') }}">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M20.5 10.19h-2.89c-2.37 0-4.3-1.93-4.3-4.3V3c0-.55-.45-1-1-1H8.07C4.99 2 2.5 4 2.5 7.57v8.86C2.5 20 4.99 22 8.07 22h7.86c3.08 0 5.57-2 5.57-5.57v-5.24c0-.55-.45-1-1-1z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M15.8 2.21c-.41-.41-1.12-.13-1.12.44v3.49c0 1.46 1.24 2.67 2.75 2.67.95.01 2.27.01 3.4.01.57 0 .87-.67.47-1.07-1.44-1.45-4.02-4.06-5.5-5.54zM13.5 13.75h-6c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h6c.41 0 .75.34.75.75s-.34.75-.75.75zM11.5 17.75h-4c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                PDL Records
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="#">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M3.23 1h8.13c.68 0 1.23.56 1.23 1.25v1.37c0 .5-.31 1.12-.62 1.43L9.32 7.42c-.37.31-.62.94-.62 1.43v2.68c0 .37-.25.87-.55 1.06l-.86.56c-.8.5-1.91-.06-1.91-1.06V8.78c0-.44-.25-1-.49-1.31l-2.34-2.5C2.24 4.66 2 4.1 2 3.72V2.29C2 1.56 2.55 1 3.23 1z">
                                                </path>
                                                <path
                                                    d="M17 2h-2.4c-.28 0-.5.22-.5.5v1.12c0 .99-.53 1.96-1.05 2.49l-2.72 2.43c-.03.07-.08.17-.11.25v2.75c0 .91-.54 1.9-1.28 2.35l-.82.53c-.46.29-.97.43-1.48.43-.46 0-.92-.12-1.34-.35-.65-.36-1.1-.95-1.3-1.63v-2.66a.47.47 0 00-.15-.35l-1-1c-.32-.31-.85-.09-.85.35V17c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M18 13.75h-5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h5c.41 0 .75.34.75.75s-.34.75-.75.75zM18 17.75h-7c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h7c.41 0 .75.34.75.75s-.34.75-.75.75z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Hearings
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="#">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M3.23 1h8.13c.68 0 1.23.56 1.23 1.25v1.37c0 .5-.31 1.12-.62 1.43L9.32 7.42c-.37.31-.62.94-.62 1.43v2.68c0 .37-.25.87-.55 1.06l-.86.56c-.8.5-1.91-.06-1.91-1.06V8.78c0-.44-.25-1-.49-1.31l-2.34-2.5C2.24 4.66 2 4.1 2 3.72V2.29C2 1.56 2.55 1 3.23 1z">
                                                </path>
                                                <path
                                                    d="M17 2h-2.4c-.28 0-.5.22-.5.5v1.12c0 .99-.53 1.96-1.05 2.49l-2.72 2.43c-.03.07-.08.17-.11.25v2.75c0 .91-.54 1.9-1.28 2.35l-.82.53c-.46.29-.97.43-1.48.43-.46 0-.92-.12-1.34-.35-.65-.36-1.1-.95-1.3-1.63v-2.66a.47.47 0 00-.15-.35l-1-1c-.32-.31-.85-.09-.85.35V17c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M18 13.75h-5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h5c.41 0 .75.34.75.75s-.34.75-.75.75zM18 17.75h-7c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h7c.41 0 .75.34.75.75s-.34.75-.75.75z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Remands
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="#">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M3.23 1h8.13c.68 0 1.23.56 1.23 1.25v1.37c0 .5-.31 1.12-.62 1.43L9.32 7.42c-.37.31-.62.94-.62 1.43v2.68c0 .37-.25.87-.55 1.06l-.86.56c-.8.5-1.91-.06-1.91-1.06V8.78c0-.44-.25-1-.49-1.31l-2.34-2.5C2.24 4.66 2 4.1 2 3.72V2.29C2 1.56 2.55 1 3.23 1z">
                                                </path>
                                                <path
                                                    d="M17 2h-2.4c-.28 0-.5.22-.5.5v1.12c0 .99-.53 1.96-1.05 2.49l-2.72 2.43c-.03.07-.08.17-.11.25v2.75c0 .91-.54 1.9-1.28 2.35l-.82.53c-.46.29-.97.43-1.48.43-.46 0-.92-.12-1.34-.35-.65-.36-1.1-.95-1.3-1.63v-2.66a.47.47 0 00-.15-.35l-1-1c-.32-.31-.85-.09-.85.35V17c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M18 13.75h-5c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h5c.41 0 .75.34.75.75s-.34.75-.75.75zM18 17.75h-7c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h7c.41 0 .75.34.75.75s-.34.75-.75.75z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Releases
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                            href="#">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M21 7v10c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V7c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M18.5 9.25h-2c-1.52 0-2.75-1.23-2.75-2.75v-2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .69.56 1.25 1.25 1.25h2c.41 0 .75.34.75.75s-.34.75-.75.75zM12 13.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75zM16 17.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h8c.41 0 .75.34.75.75s-.34.75-.75.75z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Reports
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </nav>
                        <div class="mb-10 px-2">
                            <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
                                SETTINGS
                            </p>
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('superadmin.accounts') ? 'bg-gray-200 text-main scale-95' : '' }} inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-main"
                                        href="{{ route('superadmin.accounts') }}">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M22 7.81v8.38c0 2.81-1.29 4.74-3.56 5.47-.66.23-1.42.34-2.25.34H7.81c-.83 0-1.59-.11-2.25-.34C3.29 20.93 2 19 2 16.19V7.81C2 4.17 4.17 2 7.81 2h8.38C19.83 2 22 4.17 22 7.81z"
                                                opacity=".4"></path>
                                            <path
                                                d="M18.44 21.66c-.66.23-1.42.34-2.25.34H7.81c-.83 0-1.59-.11-2.25-.34.35-2.64 3.11-4.69 6.44-4.69 3.33 0 6.09 2.05 6.44 4.69zM15.58 11.58c0 1.98-1.6 3.59-3.58 3.59s-3.58-1.61-3.58-3.59C8.42 9.6 10.02 8 12 8s3.58 1.6 3.58 3.58z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Accounts
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-200 hover:scale-95 hover:text-red-500"
                                            href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M9 7.2v9.59C9 20 11 22 14.2 22h2.59c3.2 0 5.2-2 5.2-5.2V7.2C22 4 20 2 16.8 2h-2.6C11 2 9 4 9 7.2z"
                                                    opacity=".4"></path>
                                                <path
                                                    d="M5.57 8.12l-3.35 3.35c-.29.29-.29.77 0 1.06l3.35 3.35c.29.29.77.29 1.06 0 .29-.29.29-.77 0-1.06l-2.07-2.07h10.69c.41 0 .75-.34.75-.75s-.34-.75-.75-.75H4.56l2.07-2.07c.15-.15.22-.34.22-.53s-.07-.39-.22-.53c-.29-.3-.76-.3-1.06 0z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">
                                                Logout
                                            </span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
                        <!-- === Remove and replace with your own content... === -->
                        <div class="py-4">
                            <header class="text-2xl text-white uppercase font-bold">
                                @yield('title')
                            </header>
                            <div class=" text-5xl font-dancing text-white font-extrabold text-center">
                                Changing Lives, Building a Safer Nation
                            </div>
                            <div class="mt-10">
                                {{ $slot }}
                            </div>

                        </div>
                        <!-- === End ===  -->
                    </div>
                </div>
            </main>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
