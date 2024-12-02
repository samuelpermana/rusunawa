<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'kamar_id', 'tanggal_sewa', 'tanggal_tenggat', 'status', 'total_bayar',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
       
    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_tenggat' => 'date',
    ];

    
    public function isOverdue()
    {
        $oneWeekBeforeDeadline = $this->tanggal_tenggat->subWeek();
        return now()->gt($oneWeekBeforeDeadline) && $this->status != 'selesai';
    }
}
