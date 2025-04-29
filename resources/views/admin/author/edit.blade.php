@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <main class="main-content">

        <!-- Content -->
        <div class="content">
            <h2 style="margin-bottom: 20px">Avtorni tahrirlash</h2>

            <p><strong>Ismi:</strong> {{ $author->name }}</p>
            <p><strong>Email:</strong> {{ $author->email }}</p>

            <form action="{{ route('admin.authors.assignCategories', $author->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="categories">Kategoriyalarni tanlang:</label>
                    <select name="categories[]" id="categories" multiple class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $author->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Kategoriyalarni biriktirish</button>
            </form>

        </div>
    </main>
    </div>

@endsection
