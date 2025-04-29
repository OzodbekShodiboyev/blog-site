@extends('layouts.main')
@section('title', 'Search Results')
@section('content')
    @foreach ($posts as $post)
        <div class="col-lg-6">
            <div class="position-relative mb-3">
                <img class="img-fluid w-100" src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                    style="object-fit: cover;">
                <div class="bg-white border border-top-0 p-4">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="#">
                            {{ $post->category->name ?? 'Category' }}
                        </a>
                        <a class="text-body" href="#">
                            <small>{{ $post->created_at->format('M d, Y') }}</small>
                        </a>
                    </div>

                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                        href="{{ route('post.show', $post->id) }}">
                        {{ $post->title }}
                    </a>

                    <p class="m-0">
                        {{ \Illuminate\Support\Str::limit($post->content, 100) }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
