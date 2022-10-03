<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<div id="app">
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
