@extends('admin.layouts.app')

@section('content')
    <h2 class="text-center">Daftar Pembayaran</h2>
<!-- Error Message -->
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>Booking ID</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->booking->mahasiswa->nama }}</td>
                    <td>{{ $payment->booking_id }}</td>
                    <td>
                        @if($payment->payment_proof)
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                        @else
                            Tidak ada bukti pembayaran
                        @endif
                    </td>
                    <td>{{ ucfirst($payment->status) }}</td>
                    <td>
                        <form action="{{ route('admin.payment.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        <form action="{{ route('admin.payments.updateStatus', $payment->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $payment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $payment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada pembayaran yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $payments->links() }}
@endsection
