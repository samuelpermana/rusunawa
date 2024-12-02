@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h2>Daftar Sewa</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- admin.sewa.destroy -->
        <!-- Tabel Daftar Sewa -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kode Kamar</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Tenggat</th>
                    <th>Status</th>
                    <th>Total Bayar</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sewas as $sewa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sewa->mahasiswa->nama }}</td>
                        <td>{{ $sewa->kamar->kode_kamar }}</td>
                        <td>{{ $sewa->tanggal_sewa->format('d/m/Y') }}</td>
                        <td>{{ $sewa->tanggal_tenggat->format('d/m/Y') }}</td>
                        <td>{{ $sewa->status }}</td>
                        <td>Rp. {{ number_format($sewa->total_bayar, 0, ',', '.') }}</td>

                        <!-- Status Pembayaran -->
                        <td>
                            @if($sewa->isOverdue())
                              Belum Bayar
                            @else
                                Sudah Bayar
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.sewa.edit', $sewa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Tombol Kirim Notifikasi -->
                            @if($sewa->isOverdue())
                                <form action="{{ route('admin.sewa.send_notification', $sewa->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">Kirim Notifikasi</button>
                                </form>
                                @if($sewa->mahasiswa->notifications()->where('status', 'active')->exists())
                                    <a href="{{ route('admin.sewa.notifications', $sewa->id) }}" class="btn btn-primary btn-sm">Lihat Notifikasi</a>
                                @endif
                            @endif
                            <form action="{{ route('admin.sewa.destroy', $sewa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
