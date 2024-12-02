@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Booking Kamar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Kode Kamar</th>
                <th>Tipe Kamar</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kamars as $kamar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kamar->kode_kamar }}</td>
                    <td>{{ $kamar->tipeKamar->nama }}</td>
                    <td>{{ $kamar->harga }}</td>
                    <td>{{ $kamar->status }}</td>
                    <td>
                    <a href="{{ route('register', ['kamarId' => $kamar->id]) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Book
                    </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
