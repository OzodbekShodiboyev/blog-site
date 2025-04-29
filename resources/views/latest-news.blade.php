<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="{{ route('latest-news') }}">View All</a>
                            </div>
                        </div>

                        @foreach ($posts as $post)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    @if ($post->images->count() > 0)
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                                            style="object-fit: cover;">
                                    @else
                                        <img class="img-fluid w-100" src="{{ asset('assets/img/no-image.png') }}"
                                            style="object-fit: cover;">
                                    @endif
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                href="#">
                                                {{ $post->category ? $post->category->name : 'No Category' }}
                                            </a>
                                            <a class="text-body" href="#">
                                                <small>{{ $post->created_at->format('M d, Y') }}</small>
                                            </a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                            href="{{ route('post.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                        <p class="m-0">{{ Str::limit($post->content, 100) }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="{{ asset('assets/img/user.jpg') }}"
                                                width="25" height="25" alt="">
                                            <small>{{ $post->user ? $post->user->name : 'Unknown Author' }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('post.like', $post->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-link">
                                                    <i class="far fa-thumbs-up mr-2"></i>{{ $post->likes->count() }}
                                                    Like
                                                </button>
                                            </form>
                                            <small class="ml-3"><i
                                                    class="far fa-eye mr-2"></i>{{ $post->views }}</small>
                                            <small class="ml-3"><i
                                                    class="far fa-comment mr-2"></i>{{ $post->comments->count() }}
                                                Comment</small>
                                        </div>
                                    </div>

                                    <!-- Comments Section -->
                                    <div class="bg-white border border-top-0 p-4">
                                        @foreach ($post->comments as $comment)
                                            <div class="d-flex mb-3">
                                                <img class="rounded-circle mr-2"
                                                    src="{{ asset('assets/img/user.jpg') }}" width="25"
                                                    height="25" alt="">
                                                <div>
                                                    <small>{{ $comment->user ? $comment->user->name : 'Unknown Commenter' }}</small>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        @auth
                                            <form action="{{ route('post.comment', $post->id) }}" method="POST">
                                                @csrf
                                                <textarea name="content" class="form-control" rows="3" placeholder="Add a comment..."></textarea>
                                                <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                                            </form>
                                        @endauth
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
