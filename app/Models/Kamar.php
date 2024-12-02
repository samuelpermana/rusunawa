<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kamar', 'tipe_kamar_id', 'harga', 'status',
    ];

        // Konstanta status
        const STATUS_TERSEDIA = 'tersedia';
        const STATUS_TIDAK_TERSEDIA = 'terisi';
    
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class);
    }

        // Scope untuk status tersedia
        public function scopeTersedia($query)
        {
            return $query->where('status', self::STATUS_TERSEDIA);
        }
}
