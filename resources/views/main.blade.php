@extends('layouts.main')
@section('title', 'BizNews')
@push('styles')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($posts as $post)
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img class="img-fluid h-100" src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                                style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="">{{ $post->category->name ?? 'No category' }}</a>
                                    <a class="text-white" href="">{{ $post->created_at->format('M d, Y') }}</a>
                                </div>
                                <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                    href="{{ route('post.show', $post->id) }}">{{ $post->id }}</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- Main News Slider End -->

    <!-- Featured News Slider Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                @foreach ($posts as $post)
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        <img class="img-fluid h-100" src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                            style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">{{ $post->category->name ?? 'No category' }}</a>
                                <a class="text-white"
                                    href=""><small>{{ $post->created_at->format('M d, Y') }}</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold"
                                href="post/{{ $post->id }}">{{ $post->title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="{{ route('latest-news') }}">
                                    View All
                                </a>
                            </div>
                        </div>

                        @foreach ($latestPosts as $latestPost)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    {{-- <img class="img-fluid w-100" src="{{ $latestPost->image ?? asset('assets/img/default-news.jpg') }}" style="object-fit: cover;"> --}}
                                    <img class="img-fluid w-100"
                                        src="{{ $latestPost->images->first() ? asset('storage/' . $latestPost->images->first()->image_path) : asset('assets/img/default-news.jpg') }}"
                                        style="object-fit: cover;">
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                href="#">
                                                {{ $latestPost->category->name ?? 'Category' }}
                                            </a>
                                            <a class="text-body" href="#">
                                                <small>{{ $latestPost->created_at->format('M d, Y') }}</small>
                                            </a>
                                        </div>

                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                            href="{{ route('post.show', $latestPost->id) }}">
                                            {{ \Illuminate\Support\Str::limit($latestPost->title, 50) }}
                                        </a>

                                        <p class="m-0">
                                            {{ \Illuminate\Support\Str::limit($latestPost->content, 100) }}
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2"
                                                src="{{ $latestPost->user->profile_picture ?? asset('assets/img/user.jpg') }}"
                                                width="25" height="25" alt="User Avatar">
                                            <small>{{ $latestPost->user->name ?? 'Unknown' }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">

                                            <small class="ml-3">
                                                <i class="far fa-comment mr-2"></i>{{ $latestPost->comments_count ?? 0 }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News With Sidebar End -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection

@push('scripts')
    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });
    </script>
@endpush
