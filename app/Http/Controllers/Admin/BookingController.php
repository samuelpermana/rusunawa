<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Ambil data booking beserta relasi kamar
        $bookings = Booking::with('kamar')->paginate(10);

        // Menambahkan kolom total harga untuk setiap booking
        foreach ($bookings as $booking) {
            // Menghitung lama sewa dalam bulan menggunakan diffInMonths()
            $lamaSewa = $booking->tanggal_masuk->diffInMonths($booking->tanggal_keluar);

            // Jika sewa kurang dari 1 bulan, tetap dihitung 1 bulan
            if ($lamaSewa == 0) {
                $lamaSewa = 1;
            }

            // Menghitung total harga per bulan
            $booking->total_harga = $lamaSewa * $booking->kamar->harga;
        }

        return view('admin.bookings.index', compact('bookings'));
    }


    public function edit($id)
    {
        // Menampilkan form untuk mengedit booking
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'status' => 'required|in:bookingpending,bookingconfirmed,bookingcanceled,paymentpending,paymentconfirmed,canceled',
        ]);

        // Update data booking
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus booking
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}
