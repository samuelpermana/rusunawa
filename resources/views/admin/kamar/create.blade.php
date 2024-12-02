@extends('admin.layouts.app') 
@section('content')
    <div class="container-fluid mt-4">
        <h2>Tambah Kamar</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.kamar.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_kamar">Kode Kamar</label>
                <input type="text" name="kode_kamar" id="kode_kamar" class="form-control" value="{{ old('kode_kamar') }}" required>
            </div>
            
            <!-- Dropdown untuk memilih tipe kamar -->
            <div class="form-group">
                <label for="tipe_kamar_id">Tipe Kamar</label>
                <select name="tipe_kamar_id" id="tipe_kamar_id" class="form-control" required>
                    <option value="" disabled selected>Pilih tipe kamar</option>
                    @foreach($tipeKamars as $tipeKamar)
                        <option value="{{ $tipeKamar->id }}" {{ old('tipe_kamar_id') == $tipeKamar->id ? 'selected' : '' }}>
                            {{ $tipeKamar->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
@endsection
