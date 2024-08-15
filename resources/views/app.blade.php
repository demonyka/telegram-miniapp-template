<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
