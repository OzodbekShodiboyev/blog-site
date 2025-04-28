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
                <h1>Users yaratish</h1>
                <div class="actions" style="margin-bottom: 20px;">
                    <a href="{{ route('admin.users.create') }}"
                        style="background: blue; color:#fff; text-decoration: none;padding:10px; border-radius: 10px;"
                        class="btn btn-primary">Orqaga qaytish</a>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ism</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Parol</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Parolni tasdiqlang</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="roles">Rollar</label>
                        <select name="roles[]" id="roles" class="form-control" multiple required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Yaratish</button>
                </form>


            </div>
        </main>
    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>

</html>
