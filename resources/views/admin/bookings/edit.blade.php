@extends('admin.layouts.app')

@section('content')
    <h2 class="text-center">Edit Booking</h2>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="bookingpending" {{ $booking->status == 'bookingpending' ? 'selected' : '' }}>Booking Pending</option>
                <option value="bookingconfirmed" {{ $booking->status == 'bookingconfirmed' ? 'selected' : '' }}>Booking Confirmed</option>
                <option value="bookingcanceled" {{ $booking->status == 'bookingcanceled' ? 'selected' : '' }}>Booking Canceled</option>
                <option value="paymentpending" {{ $booking->status == 'paymentpending' ? 'selected' : '' }}>Payment Pending</option>
                <option value="paymentconfirmed" {{ $booking->status == 'paymentconfirmed' ? 'selected' : '' }}>Payment Confirmed</option>
                <option value="paymentcanceled" {{ $booking->status == 'paymentcanceled' ? 'selected' : '' }}>Payment Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
