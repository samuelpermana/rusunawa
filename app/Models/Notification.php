<?php
// app/Models/Notification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'message', 'status'
    ];

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
