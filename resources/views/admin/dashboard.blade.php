<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
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
                <h1>Dashboard</h1>

                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="card">
                        <div class="card-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-info">
                            <h3>Total Users</h3>
                            <p>1,234</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon orange">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-info">
                            <h3>Authors</h3>
                            <p>89</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon green">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-info">
                            <h3>Posts</h3>
                            <p>567</p>
                        </div>
                    </div>

                </div>

                <!-- Recent Activity -->
                <div class="recent-activity">
                    <h2>Recent Activity</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Login</td>
                                <td>10:30 AM</td>
                                <td><span class="status success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>Order #123</td>
                                <td>11:15 AM</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Robert Johnson</td>
                                <td>Password change</td>
                                <td>12:00 PM</td>
                                <td><span class="status success">Success</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Emily Davis</td>
                                <td>Product added</td>
                                <td>1:45 PM</td>
                                <td><span class="status success">Success</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="{{asset('assets/js/admin.js')}}"></script>
</body>
</html>