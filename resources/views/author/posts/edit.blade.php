@extends('author.layouts.main')
@section('title', 'Dashboard')
@section('content')


<main class="main-content">
    <div class="content">
        <h1>Postni Tahrirlash</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('author.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Sarlovha</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Kontent</label>
                <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Kategoriya</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Kategoriya tanlang</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Joriy Rasmlar:</label><br>
                @if ($post->images->isNotEmpty())
                    @foreach ($post->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" width="80" height="80"
                            style="object-fit: cover; margin:5px;">
                    @endforeach
                @else
                    <p>Rasm yo'q</p>
                @endif
            </div>

            <div class="form-group">
                <label for="images">Yangi rasm yuklash (ixtiyoriy, birdan ortiq)</label>
                <input type="file" name="images[]" id="images" multiple class="form-control">
            </div>

            @if($canEditPublishedAt)
                <div class="form-group">
                    <label for="published_at">Chop etish vaqti</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                        value="{{ old('published_at', \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i')) }}">
                </div>
            @else
                <div class="form-group">
                    <label>Chop etish vaqti</label>
                    <p>{{ \Carbon\Carbon::parse($post->published_at)->format('d.m.Y H:i') }}</p>
                    <input type="hidden" name="published_at" value="{{ old('published_at', $post->published_at) }}">
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-2">Saqlash</button>
        </form>
    </div>
</main>
</div>

@endsection
