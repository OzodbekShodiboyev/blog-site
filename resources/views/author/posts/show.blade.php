<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Panel</title>
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-cog"></i>
                <span>Author Panel</span>
            </div>
           @include('author.components.navbar')
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Content -->
            <div class="content">
                <h1>Mening Postlarim</h1>
                <a style="margin-top: 30px;" href="{{ route('author.posts.create') }}" class="btn btn-primary mt-3">Yangi post yaratish</a>


                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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
    </div>

    <script src="{{asset('assets/js/admin.js')}}"></script>
</body>
</html>