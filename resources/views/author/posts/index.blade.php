@extends('author.layouts.main')
@section('title', 'Dashboard')
@section('content')

<!-- Main Content -->
<main class="main-content">

    <!-- Content -->
    <div class="content">
        <h1> Postlar</h1>
        <div class="col-12">
            <form action="" method="GET">
                <select name="category" id="category">
                    <option value="all">Barchasi</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="author" id="author">
                    <option value="all">Barchasi</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->name }}" {{ request('author') == $author->name ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

                <input type="submit" value="Filtr">
            </form>

        <div>

        {{-- <a style="margin-top: 30px;" href="{{ route('author.posts.create') }}" class="btn btn-primary mt-3">Yangi post yaratish</a> --}}

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($posts->isEmpty())
            <p>Hozircha post yaratilmagan.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Sarlovha</th>
                        <th>Kategoriya</th>
                        <th>Rasmlar</th>
                        <th>Yaratilgan</th>
                        <th>Chop etish vaqti</th>
                        <th>Muallif</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name ?? '-' }}</td>
                            <td>
                                @if($post->images->isNotEmpty())
                                    @foreach($post->images as $image)
                                        <img src="{{ asset('storage/' . $image->image_path) }}" width="50" height="50" style="object-fit: cover; margin: 2px;">
                                    @endforeach
                                @else
                                    Rasm yo'q
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                            <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.m.Y H:i') : 'Darhol' }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <a href="{{ route('author.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Tahrirlash</a>

                                <form action="{{ route('author.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Postni o‘chirmoqchimisiz?')">O'chirish</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </div>
</main>

@endsection
