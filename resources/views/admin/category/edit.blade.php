@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
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
@endsection
