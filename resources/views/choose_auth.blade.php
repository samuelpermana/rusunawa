<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Opsi</title>
    <!-- Bootstrap CSS for basic styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styling -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #AA5486;
        }
        .description {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.1rem;
        }
        .btn-primary {
            background-color: #AA5486;
            border-color: #AA5486;
        }
        .btn-secondary {
            background-color: #FC8F54;
            border-color: #FC8F54;
        }
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .image-container img {
            width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 24rem;">
            <div class="card-body text-center">
                <div class="image-container">
                    <!-- Gambar patungkuda.png -->
                    <img src="{{ asset('images/patungkuda.png') }}" alt="Patung Kuda" />
                </div>
                <h5 class="card-title mb-4">Selamat Datang di Rusunawa Undip</h5>
                <p class="description">Pilih login jika Anda sudah memiliki akun atau merupakan penghuni rusunawa Undip. Pilih daftar jika Anda belum memiliki akun dan ingin mendaftar atau melakukan booking di rusunawa Undip.</p>
                <!-- Pilihan Login dan Daftar -->
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom mb-2">Login</a>
                <br>
                <a href="{{ route('cek_kamars') }}" class="btn btn-secondary btn-custom">Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>
