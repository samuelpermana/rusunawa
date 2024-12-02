<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\Sewa;

class KamarController extends Controller
{
    public function index()
    {
        // Ambil semua kamar dengan paginasi
        $kamars = Kamar::paginate(10);

        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        // Ambil data tipe kamar untuk dropdown
        $tipeKamars = TipeKamar::all();
        return view('admin.kamar.create', compact('tipeKamars'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kode_kamar' => 'required|string|unique:kamars,kode_kamar',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);
    
        // Create kamar baru
        Kamar::create($request->all());
    
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }
    
    public function edit(Kamar $kamar)
    {   
        // Ambil tipe kamar untuk form edit
        $tipeKamars = TipeKamar::all();
        return view('admin.kamar.edit', compact('kamar', 'tipeKamars'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'kode_kamar' => 'required|string|unique:kamars,kode_kamar,' . $kamar->id,
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);
    
        // Update kamar data
        $kamar->update($request->all());
    
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {

        try {
            // Hapus kamar yang dipilih
            $kamar->delete();
    
            return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
           
        } catch (\Exception $e) {
            return redirect()->route('admin.kamar.index')->with('error', 'Terjadi kesalahan saat menghapus Kamar, Kamar Tidak bisa dihapus karena terdaftar pada Booking/Sewa ');
        }
    }

    
}
