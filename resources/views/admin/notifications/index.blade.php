@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h2>Notifikasi Mahasiswa: {{ $sewa->mahasiswa->nama }}</h2>

        <a href="{{ route('admin.sewa.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Sewa</a>

        @if($notifications->isEmpty())
            <div class="alert alert-warning">
                Tidak ada notifikasi untuk mahasiswa ini.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $notification->message }}</td>
                            <td>
                                @if($notification->status == \App\Models\Notification::ACTIVE_STATUS)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.notifications.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
