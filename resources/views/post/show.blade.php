@extends('layouts.main')
@section('title', $post->title)
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Post Header -->
                <div class="post-header text-center mb-5">
                    <h2 class="text-uppercase font-weight-bold">{{ $post->title }}</h2>
                    <p class="text-muted">
                        <small>Posted by <strong>{{ $post->user->name }}</strong> on
                            {{ $post->created_at->format('M d, Y') }}</small>
                    </p>
                </div>

                <!-- Image Gallery -->
                @if ($post->images->count() > 0)
                    <div class="mb-5 text-center">
                        <!-- Main Image -->
                        <img id="mainImage" class="img-fluid mb-3 main-image"
                            src="{{ asset('storage/' . $post->images[0]->image_path) }}" alt="Main Post Image">

                        <!-- Thumbnails -->
                        <div class="d-flex justify-content-center flex-wrap">
                            @foreach ($post->images as $image)
                                <div class="m-1" style="cursor: pointer;">
                                    <img class="thumbnail-img rounded" src="{{ asset('storage/' . $image->image_path) }}"
                                        style="width: 80px; height: 80px; object-fit: cover;"
                                        onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                        alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Post Content -->
                <div class="post-content mb-5">
                    <p class="lead">{{ $post->content }}</p>
                </div>

                <!-- Like Button -->
                @auth
                    <div class="text-center mb-5">
                        <form action="{{ route('post.like', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="far fa-thumbs-up"></i> {{ $post->likes->count() }} Like
                            </button>
                        </form>
                    </div>
                @else
                    <div class="text-center mb-5">
                        <button type="button" class="btn btn-outline-primary btn-lg"
                            onclick="alert('Please log in to like this post.')">
                            <i class="far fa-thumbs-up"></i> {{ $post->likes->count() }} Like
                        </button>
                    </div>
                @endauth

                <!-- Comments Section -->
                <div class="comments-section">
                    <h4 class="font-weight-bold mb-4">Comments ({{ $post->comments->count() }})</h4>

                    @foreach ($post->comments as $comment)
                        <div class="comment mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img class="rounded-circle"
                                    src="{{ $comment->user->profile_picture ?? asset('assets/img/user.jpg') }}"
                                    width="40" height="40" alt="User Avatar">
                                <strong class="ml-2">{{ $comment->user->name ?? 'Unknown' }}</strong>
                            </div>
                            <p class="mb-1">{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach

                    @auth
                        <div class="comment-form mt-4">
                            <form action="{{ route('post.comment', $post->id) }}" method="POST">
                                @csrf
                                <textarea class="form-control" name="content" rows="3" placeholder="Add a comment..."></textarea>
                                <button type="submit" class="btn btn-success mt-3">Post Comment</button>
                            </form>
                        </div>
                    @else
                        <p class="mt-3"><small><a href="{{ route('login') }}">Log in</a> to comment.</small></p>
                    @endauth
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function changeMainImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }
    </script>
@endpush
