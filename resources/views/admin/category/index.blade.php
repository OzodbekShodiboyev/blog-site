@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <main class="main-content">

        <!-- Content -->
        <div class="content">
            <h2 style="margin-bottom: 20px">Kategoriyalar</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Kategoriya yaratish</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categors as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                    class="btn btn-warning">Tahrirlash</a>

                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">O‘chirish</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>
    </div>
@endsection
