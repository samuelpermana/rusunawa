@extends('admin.layouts.app') <!-- Menggunakan layout admin yang sudah ada -->

@section('content')
    <div class="container-fluid mt-4">
        <h2>Tambah Mahasiswa</h2>

        <!-- Notifikasi Error -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk Menambah Mahasiswa -->
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" value="{{ old('nim') }}" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ old('fakultas') }}" required>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor HP</label>
                <input type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
