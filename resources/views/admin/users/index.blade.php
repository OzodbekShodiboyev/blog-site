@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <main class="main-content">

        <div class="content">
            <h1>Users</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="actions">
                <a href="{{ route('admin.users.create') }}"
                    style="background: blue; color:#fff; text-decoration: none;padding:10px; border-radius: 10px;"
                    class="btn btn-primary">Add User</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRoleNames()->first() }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Ushbu foydalanuvchini o‘chirishni istaysizmi?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete">Delete</button>
                                            </form>

                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-edit">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
    </main>
    </div>
@endsection
