<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tugasaurus')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    @yield('styles')
</head>
<body>
    <x:layout.navbar></x:layout.navbar>
    <x:layout.alert></x:layout.alert>

    <div>
        @yield('content')
        @yield('scripts')
    </div>

    <x:layout.footer></x:layout.footer>
</body>
</html>
