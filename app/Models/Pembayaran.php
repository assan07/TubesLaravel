<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bulan',
        'tahun',
        'tanggal_bayar',
        'status_pembayaran',
        'jenis_pembayaran',
        'harga',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranKamar::class, 'user_id', 'user_id');
    }
}
