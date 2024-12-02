@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h2>Edit Sewa Kamar</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sewa.update', $sewa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tanggal_sewa">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" value="{{ old('tanggal_sewa', $sewa->tanggal_sewa->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_tenggat">Tanggal Tenggat</label>
                <input type="date" name="tanggal_tenggat" id="tanggal_tenggat" class="form-control" value="{{ old('tanggal_tenggat', $sewa->tanggal_tenggat->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="aktif" {{ $sewa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ $sewa->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="terhenti" {{ $sewa->status == 'terhenti' ? 'selected' : '' }}>Terhenti</option>
                </select>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('admin.sewa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
