
@extends('layouts.app')

@section('content')
    <style>

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .back-to-login {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-login a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
        }


    </style>
    <div class="create-container">
        <h2>Buat Akun Mahasiswa</h2>

        <form method="POST" action="{{ route('register', $kamar->id) }}">
            @csrf

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" name="fakultas" value="{{ old('fakultas') }}" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan') }}" required>
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor Telepon</label>
                <input type="tel" name="no_hp" value="{{ old('no_hp') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" required>
            </div>

            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" required>
            </div>

            <button type="submit">Buat Akun</button>

            @error('nim')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('nama')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('fakultas')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('jurusan')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('no_hp')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </form>

        <!-- Link ke Halaman Login -->
        <div class="back-to-login">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
    @endsection