<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Sewa;
use App\Models\Payments; // Import the Payment model
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {   
        // Cek booking yang berstatus bookingpending, bookingconfirmed, atau paymentpending
        $pendingBookings = Booking::whereIn('status', ['bookingpending', 'paymentpending'])->get();
        
        // Cek sewa yang belum selesai atau memiliki status berbeda dari 'selesai'
        $overdueRentals = Sewa::where('status', '!=', 'selesai')
            ->whereDate('tanggal_tenggat', '<=', Carbon::now()->addDays(7))
            ->get();
        
        // Cek payments yang statusnya pending
        $pendingPayments = Payments::where('status', 'pending')->get();
    
        return view('admin.dashboard', compact('pendingBookings', 'overdueRentals', 'pendingPayments'));
    }

        // Method to create rental data (sewa)
    public function createSewa(Request $request)
    {
        // Validate the data
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_tenggat' => 'required|date',
            'total_bayar' => 'required|numeric',
        ]);

        // Create rental data (sewa)
        $sewa = Sewa::create([
            'mahasiswa_id' => $validated['mahasiswa_id'],
            'kamar_id' => $validated['kamar_id'],
            'tanggal_sewa' => $validated['tanggal_sewa'],
            'tanggal_tenggat' => $validated['tanggal_tenggat'],
            'status' => 'aktif',  // Set status to 'aktif'
            'total_bayar' => $validated['total_bayar'],
        ]);

        // Optionally, you can update the booking status to 'sewa_created' if necessary
        $booking = Booking::where('mahasiswa_id', $validated['mahasiswa_id'])->latest()->first();
        $booking->status = 'done';
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Data Sewa berhasil dibuat!');
    }
}
