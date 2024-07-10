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
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @vite('resources/css/app.css')

    </head>
    <body class="font-sans antialiased">
            
        <div class="flex h-screen flex-col md:flex-row md:overflow-hidden bg-slate-100">
            <aside class="w-full flex-none md:w-64 m-5 mr-0 p-5 bg-purple-900 rounded-xl">
                @include('partials.sidebar-nav')
            </aside>

            <div class="flex-grow md:overflow-y-auto md:p-5">

                @session('success')
                    <p class="bg-green-500 text-white rounded-xl mb-2 py-2 px-4">{{ $value }}</p>
                @endsession
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
