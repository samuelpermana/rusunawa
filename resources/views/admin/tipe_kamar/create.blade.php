@extends('admin.layouts.app') <!-- Menggunakan layout admin yang sudah ada -->

@section('content')
    <div class="container-fluid mt-4">
        <h2>Tambah Tipe Kamar</h2>

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
        <form action="{{ route('admin.tipe_kamar.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <!-- Tombol Simpan -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
