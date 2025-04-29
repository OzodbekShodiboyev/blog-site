@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')

    <!-- Main Content -->
    <main class="main-content">

        <!-- Content -->
        <div class="content">
            <h1>Users yaratish</h1>
            <div class="actions" style="margin-bottom: 20px;">
                <a href="{{ route('admin.users') }}"
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
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required>
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
@endsection
