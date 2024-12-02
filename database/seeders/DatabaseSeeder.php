<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Sewa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan User Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminpassword'),
            'role' => 'admin',
        ]);

        // Menambahkan User Mahasiswa
        $userMahasiswa = User::create([
            'name' => 'Mahasiswa User',
            'email' => 'user@user.com',
            'password' => bcrypt('userpassword'),
            'role' => 'user',
        ]);

        // Menambahkan Mahasiswa terkait dengan User Mahasiswa
        Mahasiswa::create([
            'nim' => '1234567890',
            'nama' => 'John Doe',
            'fakultas' => 'Fakultas Teknologi',
            'jurusan' => 'Teknik Informatika',
            'nomor' => '08123456789',
            'user_id' => $userMahasiswa->id, // Menautkan Mahasiswa dengan User
        ]);

        // Menambahkan Tipe Kamar
        TipeKamar::create(['nama' => 'Standard']);
        TipeKamar::create(['nama' => 'Deluxe']);
        
        // Menambahkan Kamar
        Kamar::create(['kode_kamar' => 'K101', 'tipe_kamar_id' => 1,'status' => 'terisi', 'harga' => 500000]);
        Kamar::create(['kode_kamar' => 'K102', 'tipe_kamar_id' => 2, 'harga' => 750000]);


        // Menambahkan Sewa
        Sewa::create([
            'mahasiswa_id' => 1,
            'kamar_id' => 1,
            'tanggal_sewa' => now(),
            'tanggal_tenggat' => now()->addMonth(),
            'status' => 'aktif',
            'total_bayar' => 500000,
        ]);
    }
}
