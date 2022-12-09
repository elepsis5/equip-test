<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <title>Laravel</title>
    </head>
    <body>
        <section id="main">
            <div class="sidebar">
                @yield('sidebar')
            </div>
            <div class="main-content">
                @yield('content')
                @yield('pagination')
            </div>
        </section>
    </body>
</html>
