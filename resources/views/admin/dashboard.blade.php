@extends('admin.layouts.app')

@section('content')
    <h2 class="text-center">Selamat datang di Dashboard Admin</h2>

    <!-- Notifikasi -->
    <div class="notifications">
        @if($pendingBookings->isNotEmpty())
            <div class="alert alert-warning">
                <h5><i class="fa fa-bell"></i> Notifikasi Booking Kamar</h5>
                <p>Terdapat {{ $pendingBookings->count() }} booking yang belum di-review.</p>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">Lihat Booking</a>
            </div>
        @endif

        @if($overdueRentals->isNotEmpty())
            <div class="alert alert-danger">
                <h5><i class="fa fa-exclamation-triangle"></i> Notifikasi Mahasiswa</h5>
                <p>Terdapat {{ $overdueRentals->count() }} mahasiswa yang belum membayar sewa dan tenggat waktu mendekati.</p>
                <a href="{{ route('admin.sewa.index') }}" class="btn btn-primary">Lihat Sewa</a>
            </div>
        @endif

        <!-- Notifikasi Pembayaran -->
        @if($pendingPayments->isNotEmpty())
            <div class="alert alert-warning">
                <h5><i class="fa fa-credit-card"></i> Notifikasi Pembayaran</h5>
                <p>Terdapat {{ $pendingPayments->count() }} pembayaran yang masih pending.</p>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-primary">Lihat Pembayaran</a>
            </div>
        @endif
    </div>

    <!-- Cards for managing rooms and students -->
    <div class="card-container">
        <!-- Card 1: Mengelola Kamar -->
        <div class="card">
            <div class="card-header">
                <h5>Kelola Kamar</h5>
            </div>
            <div class="card-body">
                <p>Kelola semua kamar yang tersedia untuk disewakan.</p>
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-warning">Lihat Kamar</a>
            </div>
        </div>

        <!-- Card 2: Mengelola Mahasiswa -->
        <div class="card">
            <div class="card-header">
                <h5>Kelola Mahasiswa</h5>
            </div>
            <div class="card-body">
                <p>Kelola data mahasiswa yang tinggal di rusunawa.</p>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-warning">Lihat Mahasiswa</a>
            </div>
        </div>
    </div>
@endsection
