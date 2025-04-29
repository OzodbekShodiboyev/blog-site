<!-- Sidebar -->
<aside class="sidebar">
    <div class="logo">
        <i class="fas fa-cog"></i>
        <span>Author Panel</span>
    </div>
    <nav class="menu">
        <ul>
            <li ><a href="{{route('author.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{route('author.posts.create')}}"><i class="fas fa-plus"></i> Create Post</a></li>
            <li><a href="{{route('author.posts.show')}}"><i class="fas fa-book"></i> My Posts</a></li>
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <i class="fas fa-sign-out-alt"></i>
                    <input type="submit" style="background:none; border: none; outline: none; color:#fff;" value="Logout">
                </form>
            </li>
        </ul>
    </nav>

</aside>
