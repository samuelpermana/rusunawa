<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sewa;
use App\Models\Notification;

class SewaController extends Controller
{
    // Menampilkan daftar sewa
    public function index()
    {
        // Ambil semua data sewa beserta mahasiswa dan kamar terkait
        $sewas = Sewa::with(['mahasiswa', 'kamar'])->get();
        return view('admin.sewa.index', compact('sewas'));
    }
    public function sendNotification($id)
    {
        $sewa = Sewa::findOrFail($id);
        
        // Pastikan tenggat waktu sudah lewat dan mahasiswa belum menerima notifikasi
        if ($sewa->isOverdue() && !$sewa->mahasiswa->notifications()->where('status', 'active')->exists()) {
            // Kirim notifikasi kepada mahasiswa
            Notification::create([
                'mahasiswa_id' => $sewa->mahasiswa_id,
                'message' => 'Anda belum melakukan pembayaran dan sudah melewati tenggat waktu bayar. Anda hanya bisa melakukan perpanjangan sewa per 1 bulan. Segera konfirmasi jika anda ingin berhenti sewa',
                'status' => Notification::ACTIVE_STATUS,
            ]);

            return redirect()->route('admin.sewa.index')->with('success', 'Notifikasi berhasil dikirim.');
        }

        return redirect()->route('admin.sewa.index')->with('error', 'Notifikasi gagal dikirim.');
    }
    public function showNotifications($sewaId)
    {
        // Ambil data Sewa berdasarkan ID
        $sewa = Sewa::findOrFail($sewaId);
        
        // Ambil semua notifikasi yang terkait dengan mahasiswa dari sewa
        $notifications = Notification::where('mahasiswa_id', $sewa->mahasiswa_id)
                                      ->get();
        
        // Kembalikan ke tampilan dengan data notifikasi
        return view('admin.notifications.index', compact('notifications', 'sewa'));
    }


// app/Http/Controllers/Admin/SewaController.php

    public function deleteNotifications($notificationId)
    {
        // Find the notification by its ID
        $notification = Notification::findOrFail($notificationId);

        // Delete the notification
        $notification->delete();

        // Redirect back with a success message
        return redirect()->route('admin.sewa.index', $notification->mahasiswa_id)
                        ->with('success', 'Notifikasi berhasil dihapus.');
    }



    // Menampilkan form untuk edit sewa
    public function edit($id)
    {
        // Cari sewa berdasarkan id
        $sewa = Sewa::findOrFail($id);
        return view('admin.sewa.edit', compact('sewa'));
    }

    // Update status, tanggal sewa, dan tanggal tenggat
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_tenggat' => 'required|date|after_or_equal:tanggal_sewa',
            'status' => 'required|in:aktif,selesai,terhenti',
        ]);

        $sewa = Sewa::findOrFail($id);
        $sewa->update([
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_tenggat' => $request->tanggal_tenggat,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sewa.index')->with('success', 'Sewa berhasil diperbarui.');
    }

    public function destroy(Sewa $sewa)
    {
        try {
            $sewa->delete();
    
            return redirect()->route('admin.sewa.index')->with('success', 'Sewa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sewa.index')->with('error', 'Terjadi kesalahan saat menghapus Sewa, Sewa Tidak bisa dihapus karena terdaftar Suatu tabel');
        }
    }
}
