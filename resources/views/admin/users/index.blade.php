<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
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
                <h1>Users</h1>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

                @endif
                <div class="actions">
                    <a href="{{ route('admin.users.create') }}" style="background: blue; color:#fff; text-decoration: none;padding:10px; border-radius: 10px;" class="btn btn-primary">Add User</a>
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
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->first()}}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </main>
    </div>

    <script src="{{asset('assets/js/admin.js')}}"></script>
</body>
</html>