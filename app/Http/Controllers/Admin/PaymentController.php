<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Menampilkan seluruh pembayaran
    public function index()
    {
        $payments = Payments::with('booking')->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    // Memperbarui status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected', // Validasi status
        ]);

        $payment = Payments::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function destroy(Payments $payment)
    {
        try {
            // Hapus kamar yang dipilih
            $payment->delete();
    
            return redirect()->route('admin.kamar.index')->with('success', 'Payment berhasil dihapus.');
           
        } catch (\Exception $e) {
            return redirect()->route('admin.kamar.index')->with('error', 'Terjadi kesalahan saat menghapus Payment, Payment Tidak bisa dihapus karena terdaftar pada Booking/Sewa ');
        }
    }
}
