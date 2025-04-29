<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="post-header mb-4">
                <h2 class="text-uppercase font-weight-bold">{{ $post->title }}</h2>
                <p class="text-muted">
                    <small>Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                </p>
            </div>

            <!-- Image Slider -->
            @if($post->images->count() > 0)
            <div id="postCarousel" class="carousel slide mb-4" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($post->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            {{-- @dd($image->image_path) --}}

                            <img class="d-block w-100" src="{{ asset('storage/' . $image->image_path) }}" alt="Post Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#postCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#postCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif


            <!-- Post Content -->
            <div class="post-content mb-4">
                <p>{{ $post->content }}</p>
            </div>

            <!-- Like Button and Count -->
            <div class="mb-4">
                <form action="{{ route('post.like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="far fa-thumbs-up"></i> {{ $post->likes->count() }} Like
                    </button>
                </form>
            </div>

            <div class="comments-section">
                <h4 class="font-weight-bold">Comments ({{ $post->comments->count() }})</h4>

                @foreach($post->comments as $comment)
                    <div class="comment mb-3">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="{{ $comment->user->profile_picture ?? asset('assets/img/user.jpg') }}" width="30" height="30" alt="User Avatar">
                            <strong class="ml-2">{{ $comment->user->name ?? 'Unknown' }}</strong>
                        </div>
                        <p class="mt-2">{{ $comment->content }}</p>
                        <p><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                    </div>
                @endforeach

                @auth
                    <div class="comment-form">
                        <form action="{{ route('post.comment', $post->id) }}" method="POST">
                            @csrf
                            <textarea class="form-control" name="content" rows="3" placeholder="Add a comment..."></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Post Comment</button>
                        </form>
                    </div>
                @else
                    <p><small><a href="{{ route('login') }}">Log in</a> to comment.</small></p>
                @endauth
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
