<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'nama', 'fakultas', 'jurusan', 'nomor', 'user_id', // Tambahkan 'user_id'
    ];

    /**
     * Relasi One-to-One dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

        // Relasi ke model Notification
        public function notifications()
        {
            return $this->hasMany(Notification::class);
        }

}
