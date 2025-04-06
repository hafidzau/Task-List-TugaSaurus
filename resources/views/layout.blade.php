
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tugasaurus')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
</head>
<body>
    <x:navbar></x:navbar>

    @yield('content')

    @yield('scripts')
    <x:footer></x:footer>
</body>
</html>
