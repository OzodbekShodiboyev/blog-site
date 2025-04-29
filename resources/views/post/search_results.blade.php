@extends('layouts.main')

@section('title', 'Search Results')

@section('content')
<div class="container">
    <h2 class="mb-4">Qidiruv Natijalari</h2>

    @if($posts->isEmpty())
        <div class="alert alert-warning">
            <strong>Xatolik!</strong> Bunday natijalar topilmadi.
        </div>
    @else
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                    </h5>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <p class="card-text"><small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small></p>
                </div>
            </div>
        @endforeach

        <!-- Paginatsiya -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }} <!-- Laravel paginatsiya links -->
        </div>
    @endif
</div>
@endsection
