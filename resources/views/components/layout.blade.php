<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles & Fonts -->
    @include('layouts.partials.styles')

</head>

<body class="antialiased bg-gray-200 dark:bg-gray-800">
    <div class="flex flex-col h-screen w-full">
        <!-- pl-8 md:pl-16 lg:pl-32 xl:pl-64 -->
        <!-- @include('layouts.partials.header')

        <main class="container mt-5 flex-grow">
            {{ $slot ?? null}}
        </main>

        @include('layouts.partials.footer')

        @include('layouts.partials.scripts') -->
    </div>
</body>

</html>