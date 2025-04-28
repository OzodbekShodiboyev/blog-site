<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-cog"></i>
                <span>Admin Panel</span>
            </div>
            @include('admin.components.navbar')
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Content -->
            <div class="content">
                <h2 style="margin-bottom: 20px">Kategoriyani tahrirlash</h2>

                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Kategoriya nomi</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Yangilash</button>
                </form>


            </div>
        </main>
    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>

</html>
