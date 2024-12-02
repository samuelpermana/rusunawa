@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Tipe Kamar</h2>

<!-- Error Message -->
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.tipe_kamar.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Tipe Kamar</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipeKamars as $tipe_kamar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tipe_kamar->nama }}</td>>
                    <td>
                        <a href="{{ route('admin.tipe_kamar.edit', $tipe_kamar->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.tipe_kamar.destroy', $tipe_kamar->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $tipeKamars->links() }}
    </div>
</div>
@endsection
