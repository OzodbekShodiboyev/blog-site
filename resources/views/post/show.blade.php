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

                <div class="post-content mb-5">
                    <p class="lead">{{ $post->content }}</p>
                </div>

                @auth
                    <div class="text-center mb-5">
                        <form class="like-form" data-post-id="{{ $post->id }}">
                            @csrf
                            <button type="submit" class="btn btn-link like-btn">
                                <i class="far fa-thumbs-up mr-2"></i><span class="like-count">{{ $post->likes->count() }}</span> Like
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
                    <div class="comments-section">
                        <div class="comments-list">
                            @foreach ($post->comments as $comment)
                                <div class="d-flex mb-3">
                                    <img class="rounded-circle mr-2" src="{{ asset('assets/img/user.jpg') }}" width="25" height="25" alt="">
                                    <div>
                                        <small>{{ $comment->user ? $comment->user->name : 'Unknown Commenter' }}</small>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @auth
                        <form class="comment-form" data-post-id="{{ $post->id }}">
                            @csrf
                            <textarea name="content" class="form-control" rows="3" placeholder="Add a comment..."></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                        </form>
                        @endauth
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".like-form").submit(function(e) {
                e.preventDefault();

                var postId = $(this).data("post-id");
                var likeCountElement = $(this).find(".like-count");

                $.ajax({
                    url: "/post/like/" + postId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        likeCountElement.text(response.likeCount);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error);
                    }
                });
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $(".comment-form").submit(function(e) {
                e.preventDefault();

                var postId = $(this).data("post-id");
                var content = $(this).find("textarea[name='content']").val();
                var commentContainer = $(this).closest(".comments-section").find(".comments-list");

                $.ajax({
                    url: "/post/comment/" + postId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: content,
                    },
                    success: function(response) {
                        var commentHtml = '<div class="d-flex mb-3"><img class="rounded-circle mr-2" src="{{ asset('assets/img/user.jpg') }}" width="25" height="25" alt=""><div><small>' + response.userName + '</small><p>' + response.content + '</p></div></div>';
                        commentContainer.prepend(commentHtml);
                        $("textarea[name='content']").val('');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error);
                    }
                });
            });
        });
    </script>

@endpush
