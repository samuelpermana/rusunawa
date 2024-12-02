<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CekKamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::tersedia()->get();
        return view('user.kamar.index', compact('kamars'));
    }

    // Menampilkan form registrasi dan booking kamar
    public function showRegistrationForm($kamarId)
    {
        $kamar = Kamar::findOrFail($kamarId);
        return view('user.kamar.register', compact('kamar'));
    }

    public function register(Request $request, $kamarId)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'no_hp' => 'required|numeric|min:10',
            'password' => 'required|confirmed|min:6',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register', $kamarId)
                             ->withErrors($validator)
                             ->withInput();
        }

        // Buat akun mahasiswa
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';  // Set role sebagai mahasiswa
        $user->save();

        // Buat data mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->nomor = $request->no_hp;
        $mahasiswa->user_id = $user->id;
        $mahasiswa->save();

        // Buat booking
        $booking = new Booking();
        $booking->mahasiswa_id = $mahasiswa->id;
        $booking->kamar_id = $kamarId;
        $booking->tanggal_masuk = $request->tanggal_masuk;
        $booking->tanggal_keluar = $request->tanggal_keluar;
        $booking->status = 'bookingpending'; // Atau status lain sesuai kebutuhan
        $booking->save();

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}
