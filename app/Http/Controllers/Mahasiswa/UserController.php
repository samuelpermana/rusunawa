<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payments;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // Get the current logged-in mahasiswa
        $user = Auth::user()->mahasiswa->id;
        
        // Get the latest booking for the mahasiswa
        $booking = Booking::where('mahasiswa_id', $user)->latest()->first();
    
        // Get active notifications for the mahasiswa
        $notifications = Notification::where('mahasiswa_id', $user)
                                      ->where('status', Notification::ACTIVE_STATUS)
                                      ->get();
    
        if ($booking) {
            // Calculate the rental duration in months
            $lamaSewa = $booking->tanggal_masuk->diffInMonths($booking->tanggal_keluar);
    
            // If the duration is less than 1 month, set it to 1
            if ($lamaSewa == 0) {
                $lamaSewa = 1;
            }
    
            // Calculate the total price to be paid
            $totalHarga = $lamaSewa * $booking->kamar->harga;
    
            // Pass the booking data, rental duration, total price, and notifications to the view
            return view('user.dashboard', compact('booking', 'lamaSewa', 'totalHarga', 'notifications'));
        }
    
        return redirect()->route('user.dashboard')->with('error', 'Booking tidak ditemukan!');
    }
    
    public function uploadPayment(Request $request)
    {
        try {
            $request->validate([
                'payment_proof' => 'required|image|max:2048', // Maksimal 2MB
                'agreement_proof' => 'required|file|max:2048',
            ]);

            $user = Auth::user()->mahasiswa->id;

            $booking = Booking::where('mahasiswa_id', $user)
                ->where('status', Booking::STATUS_BOOKING_CONFIRMED)
                ->latest()
                ->first();

            if (!$booking) {
                return redirect()->back()->with('error', 'Tidak ada booking yang valid untuk diunggah.');
            }

            // Simpan file
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $agreementProofPath = $request->file('agreement_proof')->store('agreement_proofs', 'public');

            // Update booking
            $booking->update([
                'payment_proof' => $paymentProofPath,
                'agreement_proof' => $agreementProofPath,
                'status' => Booking::STATUS_PAYMENT_PENDING,
            ]);

            // Tambahkan data ke tabel payments
            Payments::create([
                'booking_id' => $booking->id,
                'payment_proof' => $paymentProofPath,
                'status' => 'pending',
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran dan surat perjanjian berhasil diunggah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function uploadPaymentProof(Request $request)
    {
        try {
            $request->validate([
                'payment_proof' => 'required|image|max:2048',
            ]);

            $user = Auth::user()->mahasiswa->id;

            $booking = Booking::where('mahasiswa_id', $user)
                ->latest()
                ->first();

            if (!$booking) {
                return redirect()->back()->with('error', 'Tidak ada booking yang valid untuk diunggah.');
            }

            // Simpan file
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
           
            Payments::create([
                'booking_id' => $booking->id,
                'payment_proof' => $paymentProofPath,
                'status' => 'pending',
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran dan surat perjanjian berhasil diunggah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();
    
            $user = Auth::user();
            
            // Ambil ID mahasiswa terkait user
            $mahasiswaId = DB::table('mahasiswas')->where('user_id', $user->id)->value('id');
    
            if ($mahasiswaId) {
                // Hapus payments terkait mahasiswa melalui booking
                $bookingId = DB::table('bookings')->where('mahasiswa_id', $mahasiswaId)->value('id');
                if ($bookingId) {
                    DB::table('payments')->where('booking_id', $bookingId)->delete();
    
                    // Hapus booking terkait mahasiswa
                    DB::table('bookings')->where('id', $bookingId)->delete();
                }
    
                // Hapus data mahasiswa
                DB::table('mahasiswas')->where('id', $mahasiswaId)->delete();
            }
    
            // Hapus user
            DB::table('users')->where('id', $user->id)->delete();
    
            // Komit transaksi
            DB::commit();
    
            // Redirect ke halaman utama dengan pesan sukses
            return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Kembali dengan JSON jika terjadi kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus akun.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
