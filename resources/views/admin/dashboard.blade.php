@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <main class="main-content">

        <!-- Content -->
        <div class="content">
            <h1>Dashboard</h1>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card">
                    <div class="card-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-info">
                        <h3>Total Users</h3>
                        <p>{{$userData['userCount']}}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon orange">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-info">
                        <h3>Categories</h3>
                        <p>{{$userData['categoriesCount']}}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon green">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-info">
                        <h3>Posts</h3>
                        <p>{{$userData['postCount']}}</p>
                    </div>
                </div>

            </div>


        </div>
    </main>

@endsection
