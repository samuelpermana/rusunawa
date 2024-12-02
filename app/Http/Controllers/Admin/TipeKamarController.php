<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeKamar;

class TipeKamarController extends Controller
{
    public function index()
    {
        $tipeKamars = TipeKamar::paginate(10);
        return view('admin.tipe_kamar.index', compact('tipeKamars'));
    }

    public function create()
    {
        return view('admin.tipe_kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:tipe_kamars,nama',
        ]);

        $tipe_kamar = TipeKamar::create([
            'nama' => $request->nama
        ]);
        return redirect()->route('admin.tipe_kamar.index')->with('success', 'Tipe Kamar berhasil ditambahkan.');
    }

    public function edit(TipeKamar $tipe_kamar)
    {
        return view('admin.tipe_kamar.edit', compact('tipe_kamar'));
    }

    public function update(Request $request, TipeKamar $tipe_kamar)
    {
        $request->validate([
            'nama' => 'required|unique:tipe_kamars,nama,' . $tipe_kamar->id,
        ]);
        $tipe_kamar->update([
            'nama' => $request->nama,
        ]);
        return redirect()->route('admin.tipe_kamar.index')->with('success', 'Tipe Kamar berhasil diperbarui.');
    }

    // Delete Tipe Kamar
    public function destroy(TipeKamar $tipe_kamar)
    {
        try {
            //code...
            $tipe_kamar->delete();
    
            return redirect()->route('admin.tipe_kamar.index')->with('success', 'Tipe Kamar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipe_kamar.index')->with('error', 'Terjadi kesalahan saat menghapus Tipe Kamar, Tipe Kamar Tidak bisa dihapus karena terdaftar pada Daftar Kamar ');
        }
    }

}
