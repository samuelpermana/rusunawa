@extends('admin.layouts.app') <!-- Menggunakan layout admin yang sudah ada -->

@section('content')
    <div class="container-fluid mt-4">
        <h2>Edit Tipe Kamar</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.tipe_kamar.update', $tipe_kamar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $tipe_kamar->nama) }}" required>
            </div>
            <!-- Tombol Update -->
            <div class="mt-3">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('admin.tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
