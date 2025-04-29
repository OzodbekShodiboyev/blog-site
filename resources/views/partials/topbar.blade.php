<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center bg-dark px-lg-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-sm bg-dark p-0">
                <ul class="navbar-nav ml-n2">
                    <li class="nav-item ">
                        {{-- <a class="nav-link text-body small" href="#">Login</a> --}}
                        @auth
                            <a href="{{ url('/') }}"
                                class="nav-link text-body small nav-item border-right border-secondary">
                                {{ Auth::user()->name }}
                            </a>
                        <li class="nav-item border-right border-secondary">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button style="background: none; outline: none; border: none;" type="submit"
                                    class="nav-link text-body small ">
                                    Log out
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item border-right border-secondary">
                            <a href="{{ route('login') }}" class="nav-link text-body small">
                                Log in
                            </a>
                        </li>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link text-body small">
                                Register
                            </a>
                        @endif
                    @endauth
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row align-items-center bg-white py-3 px-lg-5">
        <div class="col-lg-4">
            <a href="index.html" class="navbar-brand p-0 d-none d-lg-block">
                <h1 class="m-0 display-4 text-uppercase text-primary">Biz<span
                        class="text-secondary font-weight-normal">News</span></h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <a href="https://htmlcodex.com"><img class="img-fluid" src="assets/img/ads-728x90.png"
                    alt=""></a>
        </div>
    </div>
</div>
