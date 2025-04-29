<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-cog"></i>
                <span>Admin Panel</span>
            </div>
            @include('admin.components.navbar')
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Content -->
            <div class="content">
                <h2 style="margin-bottom: 20px">Avtorlar</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Ism</th>
                            <th>Email</th>
                            <th>Biriktirilgan Kategoriyalar</th>
                            <th>Amallar</th> <!-- Yangi column qo'shdik -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->email }}</td>
                                <td>
                                    @foreach($author->categories as $category)
                                        <span>{{ $category->name }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Tahrirlash tugmasi -->
                                    <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-edit">
                                        <i class="fas fa-edit"></i> Tahrirlash
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </main>
    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>

</html>
