@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <main class="main-content">

        <!-- Content -->
        <div class="content">
            <h2 style="margin-bottom: 20px">Kategoriya yaratish</h2>


            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Kategoriya nomi</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Yaratish</button>
            </form>

        </div>
    </main>
    </div>

@endsection
