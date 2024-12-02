<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporAPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling Navbar */
        .navbar {
            /* background-color: #f1efe7 !important; */
        }

        .navbar-brand {
            color: #AA5486 !important;
            font-weight: bold;
        }

        .nav-link {
            color: #AA5486 !important;
            font-weight: bold;
            margin: 0 10px;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        /* Admin login icon */
        .admin-login-icon {
            width: 24px;
            height: 24px;
            filter: invert(0%);
        }

        .admin-login-icon:hover {
            filter: invert(50%);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Ujung kiri: Brand -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo_undip.png') }}" alt="LaporAPP Logo" style="height: 80px;"> <!-- Ganti ukuran logo -->
        </a>

        <!-- Menu Tengah -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fasilitas">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#lokasi">Lokasi</a>
                </li>
            </ul>
        </div>

        <!-- Ujung kanan: Login Admin -->
        <a class="nav-link" href="/login">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Login Admin" class="admin-login-icon">
        </a>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menentukan link aktif berdasarkan URL saat ini
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
</script>
</body>
</html>
