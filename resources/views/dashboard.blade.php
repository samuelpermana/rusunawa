@extends('layouts.app')

@section('title', 'Dashboard - Rusunawa Undip')

@section('content')
    <div id="beranda" class="container mt-5">
        <div class="jumbotron position-relative p-5 rounded shadow text-dark">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <h1 class="display-4 font-relax">Rusunawa Universitas Diponegoro</h1>
                    <blockquote class="blockquote mt-4">
                        <p class="mb-0">Rumah Susun Sederhana Sewa (Rusunawa) Undip adalah hunian nyaman yang disediakan oleh Universitas Diponegoro untuk menunjang kebutuhan tempat tinggal mahasiswa selama masa studi.</p>
                    </blockquote>
                    <!-- Tombol Daftar -->
                    <a href="/choose-auth" class="btn btn-primary mt-4" style="background-color: #FC8F54; border-color: #FC8F54;">Daftar Sekarang</a>
                </div>
                <div class="col-lg-6 col-md-12 text-center">
                    <img src="{{ asset('images/rusun.png') }}" alt="Ilustrasi Rusunawa" class="img-fluid" style="max-height: 700px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
<!-- Fasilitas Section -->
<div id="fasilitas" class="container mt-5">
    <div class="row align-items-center mb-4">
        <!-- Gambar Kuda -->
        <div class="col-md-4 text-center">
            <img src="{{ asset('images/patungkuda.png') }}" alt="Gambar Kuda" class="img-fluid" style="max-width: 100%; height: auto;">
        </div>
        <!-- Judul -->
        <div class="col-md-8">
            <h2 class="font-relax mb-3">Fasilitas Rusunawa Undip</h2>
            <p class="font-relax-tag">Temukan berbagai fasilitas unggulan yang menunjang kenyamanan Anda selama tinggal di Rusunawa Universitas Diponegoro.</p>
            
        <!-- Carousel -->
        <div id="fasilitasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <!-- Carousel Item 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Kamar Nyaman</h5>
                                    <p class="card-text font-relax-tag">Kamar dengan fasilitas lengkap seperti tempat tidur, lemari, dan meja belajar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Akses Internet</h5>
                                    <p class="card-text font-relax-tag">WiFi gratis dengan kecepatan tinggi untuk menunjang kebutuhan belajar dan hiburan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Listrik dan Air</h5>
                                    <p class="card-text font-relax-tag">Listrik dan air tersedia tanpa biaya tambahan untuk kebutuhan sehari-hari Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Item 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Lokasi Strategis</h5>
                                    <p class="card-text font-relax-tag">Dekat dengan kampus Universitas Diponegoro untuk memudahkan mobilitas Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Tempat Ibadah</h5>
                                    <p class="card-text font-relax-tag">Mushola yang nyaman untuk mendukung kegiatan ibadah penghuni.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card fasilitas-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title font-relax">Ruang Belajar</h5>
                                    <p class="card-text font-relax-tag">Fasilitas ruang belajar yang cocok untuk diskusi kelompok maupun belajar individu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
    <!-- Video Profil Section -->
<div id="profil">
    <div class="container">
        <h2 class="font-relax text-center mb-4">Profil Rusunawa Universitas Diponegoro</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="ratio ratio-16x9" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);">
                    <iframe 
                        src="https://www.youtube.com/embed/ANtY7ymn5T0" 
                        title="Profil Rusunawa Universitas Diponegoro" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

    <div id="lokasi">
    <div class="container">
        <h2 class="font-relax text-center mb-4">Lokasi dan Kontak Rusunawa Universitas Diponegoro</h2>
        <div class="row justify-content-center align-items-center">
            <!-- Bagian Kontak -->
            <div class="col-lg-4 mb-4">
                <div class="card p-4 shadow-sm border-0" style="background-color: #FFF5E1; border-radius: 20px;">
                    <h4 class="mb-3">Kontak Kami</h4>
                    <ul class="list-unstyled">
                        <li><strong>Alamat:</strong> Jl. Prof. Sudarto, Tembalang, Semarang, Jawa Tengah</li>
                        <li><strong>Telepon:</strong> (024) 123-4567</li>
                        <li><strong>Email:</strong> rusunawa@undip.ac.id</li>
                        <li><strong>Jam Operasional:</strong> Senin - Jumat, 08.00 - 16.00</li>
                    </ul>
                </div>
            </div>
            <!-- Garis Tengah -->
            <div class="col-12 d-lg-none my-3">
                <hr class="border-dark">
            </div>
            <div class="col-lg-1 d-none d-lg-flex justify-content-center">
                <div class="vertical-line"></div>
            </div>
            <!-- Bagian Peta -->
            <div class="col-lg-6">
                <div class="ratio ratio-4x3" style="border-radius: 20px; overflow: hidden; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8145563315267!2d110.42283581533172!3d-7.004417294936579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c36eb7c77d5%3A0x22e94bc7b59ef4e2!2sRusunawa%20Universitas%20Diponegoro!5e0!3m2!1sen!2sid!4v1697202352921!5m2!1sen!2sid"
                        width="600" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');
        .ratio {
            border-radius: 10px; /* Opsional: Membuat sudut sedikit melengkung */
            overflow: hidden; /* Untuk memastikan sudut frame video mengikuti border-radius */
            box-shadow: 0px 60px 100px rgba(0, 0, 0, 0.3); /* Shadow */
        }

        .jumbotron {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.1),
                        0px 0px 30px 5px rgba(170, 84, 134, 0.5),
                        inset 0 0 50px 10px linear-gradient(45deg, #AA5486, #FC8F54);
        }

        .font-relax {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: #AA5486;
        }

        .font-relax-tag {
            font-family: 'Quicksand', sans-serif;
            font-weight: 400;
            color: #6e7e91;
        }

        .fasilitas-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .fasilitas-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #334eac;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        #lokasi {
            /* background-color: #FDE7BB; */
            padding: 30px; /* Opsional */
            border-radius: 15px; /* Opsional */
            width: 100%;
        }

        #lokasi .container {
            max-width: 1200px;
        }

        #lokasi .card {
            border-radius: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        #lokasi .card h4 {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        #lokasi .card ul {
            padding-left: 0;
            list-style: none;
        }

        #lokasi .card li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }

        /* Garis Vertikal */
        .vertical-line {
            width: 2px;
            height: 100%;
            background-color: #333;
        }

        /* Responsivitas */
        @media (max-width: 992px) {
            #lokasi .vertical-line {
                display: none;
            }
            #lokasi hr {
                display: block;
            }
        }
    </style>
@endsection
