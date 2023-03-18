<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Guzanet') }} - @yield('title')</title>

    <!-- Styles & Fonts -->
    @include('layouts.partials.styles')

</head>

<body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
    <div x-bind:class="{'dark' : darkMode === true}" class="min-h-screen bg-gray-100">

        <!-- pl-8 md:pl-16 lg:pl-32 xl:pl-64 -->

        <main class="text-blue-800 bg-blue-100 dark:bg-blue-800 dark:text-blue-50">
            @include('layouts.partials.header')
            {{ $slot ?? null}}
            @include('layouts.partials.footer')
        </main>

        @include('layouts.partials.scripts')
    </div>
</body>

</html>