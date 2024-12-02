<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rusunawa Universitas Diponegoro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #FDE7BB;
            padding-top: 20px;
            padding-left: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar .nav-item {
            margin: 10px 0;
        }
        .sidebar .nav-item a {
            color: #333;
            font-size: 16px;
            text-decoration: none;
        }
        .sidebar .nav-item a:hover {
            background-color: #ffcc00;
            border-radius: 5px;
            color: #fff;
        }
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .content.collapsed {
            margin-left: 0;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            width: 18rem;
        }
        .card-header {
            background-color: #ffcc00;
            color: #fff;
            font-weight: bold;
        }
        .card-body {
            background-color: #fff;
        }
        .notification {
            background-color: #ffeb3b;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/admin/dashboard" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('admin.mahasiswa.index') }}" class="nav-link">Mengelola Mahasiswa</a></li>
            <li class="nav-item"><a href="{{ route('admin.tipe_kamar.index') }}" class="nav-link">Mengelola Tipe Kamar</a></li>
            <li class="nav-item"><a href="{{ route('admin.kamar.index') }}" class="nav-link">Mengelola Kamar</a></li>
            <li class="nav-item"><a href="{{ route('admin.sewa.index') }}" class="nav-link">Daftar Sewa</a></li>
            <li class="nav-item"><a href="{{ route('admin.bookings.index') }}" class="nav-link">Daftar Booking</a></li>
            <li class="nav-item"><a href="{{ route('admin.payments.index') }}" class="nav-link">Daftar Pembayaran</a></li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        <!-- Include the Navbar -->
        @include('admin.components.navbar')

        <!-- Main Content -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar visibility
        document.getElementById("sidebarToggleBtn").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("content").classList.toggle("collapsed");
        });
    </script>
</body>
</html>
