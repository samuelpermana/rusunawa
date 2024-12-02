@extends('admin.layouts.app')

@section('content')
    <h2 class="text-center">Daftar Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Booking</th>
                <th>Nama Mahasiswa</th>
                <th>Kode Kamar</th>
                <th>Tipe Kamar</th>
                <th>Harga</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Lama Sewa (Bulan)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Surat Perjanjian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                    <td>{{ $booking->mahasiswa->nama }}</td>
                    <td>{{ $booking->kamar->kode_kamar }}</td>
                    <td>{{ $booking->kamar->tipeKamar->nama }}</td>
                    <td>Rp {{ number_format($booking->kamar->harga, 2) }}</td>
                    <td>{{ $booking->tanggal_masuk->format('d M Y') }}</td>
                    <td>{{ $booking->tanggal_keluar->format('d M Y') }}</td>
                    <td>{{ $booking->tanggal_masuk->diffInMonths($booking->tanggal_keluar) }} bulan</td>
                    <td>Rp {{ number_format($booking->total_harga, 2) }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if ($booking->payment_proof)
                            <a href="{{ Storage::url($booking->payment_proof) }}" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </td>
                    <td>
                        @if ($booking->agreement_proof)
                            <a href="{{ Storage::url($booking->agreement_proof) }}" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                        @else
                            <span class="text-muted">Belum diunggah</span>
                        @endif
                    </td>
                    <td>
                        @if ($booking->status == 'paymentconfirmed')
                            <form action="{{ route('admin.sewa.create') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="mahasiswa_id" value="{{ $booking->mahasiswa_id }}">
                                <input type="hidden" name="kamar_id" value="{{ $booking->kamar_id }}">
                                <input type="hidden" name="tanggal_sewa" value="{{ $booking->tanggal_masuk->format('Y-m-d') }}">
                                <input type="hidden" name="tanggal_tenggat" value="{{ $booking->tanggal_keluar->format('Y-m-d') }}">
                                <input type="hidden" name="total_bayar" value="{{ $booking->total_harga }}">
                                <button type="submit" class="btn btn-success btn-sm">Buat Data Sewa</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Respon</a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $bookings->links() }}
@endsection
