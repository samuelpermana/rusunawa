<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_proof',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
