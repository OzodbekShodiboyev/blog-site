
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    @stack('styles') <!-- Sahifaga maxsus css qo'shish uchun -->
</head>

<body>

    <!-- Navbar yoki Header -->
    @include('partials.topbar') <!-- Agar header bo'lsa -->
    @include('partials.navbar') <!-- Agar navbar bo'lsa -->

    <div class="container mt-4">
        @yield('content') <!-- Har sahifa uchun alohida content -->
    </div>

    <!-- Footer -->
    @include('partials.footer') <!-- Agar footer bo'lsa -->

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts') <!-- Sahifaga maxsus script qo'shish uchun -->
</body>

</html>
