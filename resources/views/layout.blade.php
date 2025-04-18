
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tugasaurus')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    @yield('styles')
</head>
<body>

    <x:layout.navbar></x:layout.navbar>
    <x:layout.alert></x:layout.alert>


    @yield('content')

    @yield('scripts')


    <x:layout.footer></x:layout.footer>
</body>
</html>
