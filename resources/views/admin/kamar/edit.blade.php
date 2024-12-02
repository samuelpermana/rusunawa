@extends('admin.layouts.app') 
@section('content')
    <div class="container-fluid mt-4">
        <h2>Edit Kamar</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_kamar">Kode Kamar</label>
                <input type="text" name="kode_kamar" id="kode_kamar" class="form-control" value="{{ old('kode_kamar', $kamar->kode_kamar) }}" required>
            </div>

            <!-- Dropdown untuk memilih tipe kamar -->
            <div class="form-group">
                <label for="tipe_kamar_id">Tipe Kamar</label>
                <select name="tipe_kamar_id" id="tipe_kamar_id" class="form-control" required>
                    <option value="" disabled>Pilih tipe kamar</option>
                    @foreach($tipeKamars as $tipeKamar)
                        <option value="{{ $tipeKamar->id }}" {{ old('tipe_kamar_id', $kamar->tipe_kamar_id) == $tipeKamar->id ? 'selected' : '' }}>
                            {{ $tipeKamar->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="form-control" value="{{ old('harga', $kamar->harga) }}" required>
            </div>

            <!-- Dropdown untuk memilih status kamar -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="" disabled>Pilih Status</option>
                    <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ old('status', $kamar->status) == 'terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
