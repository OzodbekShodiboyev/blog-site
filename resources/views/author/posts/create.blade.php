@extends('author.layouts.main')
@section('title', 'Dashboard')
@section('content')

        <main class="main-content">

            <!-- Content -->
            <div class="content">
                <h1>Dashboard</h1>

                @if ($categories->isEmpty())
                    <div class="alert alert-warning">
                        Sizga hali hech qanday kategoriya biriktirilmagan. Admin bilan bog'laning.
                    </div>
                @else
                    <form action="{{ route('author.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Sarlovha</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Kontent</label>
                            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Kategoriya</label>
                            <select name="category_id" id="category" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="images">Rasm yuklash (bir nechta)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple
                                accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="published_at">Chop etish vaqti (ixtiyoriy)</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-control">
                            <small class="form-text text-muted">Agar bo‘sh qoldirilsa, post hozirda chop etiladi.</small>
                        </div>


                        <button type="submit" class="btn btn-primary mt-2">Post yaratish</button>
                    </form>
                @endif



            </div>
        </main>
    </div>
@endsection
