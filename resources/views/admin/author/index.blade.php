@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
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
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td>
                                @foreach ($author->categories as $category)
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

@endsection
