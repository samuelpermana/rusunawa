<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{
    // Display all mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::paginate(10);
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    // Show form to create new mahasiswa
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    // Store a new mahasiswa
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Create mahasiswa and associate with the user
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'nomor' => $request->nomor,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    // Show form to edit mahasiswa
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    // Update mahasiswa data
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validate request data
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user->id,
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
        ]);

        // Update mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'nomor' => $request->nomor,
        ]);

        // Update user associated with mahasiswa
        $mahasiswa->user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        try {
            // Cek apakah mahasiswa terkait dengan booking
            if ($mahasiswa->booking()->exists()) {
                return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak dapat dihapus karena terkait dengan sewa/booking tertentu.');
            }
    
            // Hapus user terkait dengan mahasiswa
            $mahasiswa->user->delete();
    
            // Hapus mahasiswa
            $mahasiswa->delete();
    
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Terjadi kesalahan saat menghapus mahasiswa, Mahasiswa Tidak bisa dihapus karena terdaftar pada booking/sewa ');
        }
    }
    
}
