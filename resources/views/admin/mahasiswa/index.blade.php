@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Mahasiswa</h2>

<!-- Error Message -->
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


    <!-- Add Mahasiswa Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Mahasiswa</a>
    </div>

    <!-- Mahasiswa Table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Fakultas</th>
                <th>Program Studi</th>
                <th>Nomor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->fakultas }}</td>
                    <td>{{ $mahasiswa->jurusan }}</td>
                    <td>{{ $mahasiswa->user->email }}</td>
                    <td>{{ $mahasiswa->nomor }}</td>
                    <td>
                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $mahasiswas->links() }}
    </div>
</div>
@endsection
