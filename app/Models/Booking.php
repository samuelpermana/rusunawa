<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'kamar_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'status',
        'payment_proof',
        'agreement_proof',
    ];

    // Status constants for easier reference in the application
    const STATUS_BOOKING_PENDING = 'bookingpending';
    const STATUS_BOOKING_CONFIRMED = 'bookingconfirmed';
    const STATUS_BOOKING_CANCELED = 'bookingcanceled';
    const STATUS_PAYMENT_PENDING = 'paymentpending';
    const STATUS_PAYMENT_CONFIRMED = 'paymentconfirmed';
    const STATUS_PAYMENT_CANCELED = 'paymentcanceled';
    const DONE = 'done';

    protected $dates = ['tanggal_masuk', 'tanggal_keluar'];

    // Explicitly parse date attributes into Carbon instances
    public function getTanggalMasukAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getTanggalKeluarAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
