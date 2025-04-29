<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
</head>

<body>
    <div class="container">
        @include('admin.partials.sidebar')

        @yield('content')
    </div>

    @stack('scripts')
    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>
