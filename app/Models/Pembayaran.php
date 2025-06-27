<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
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
    // relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }

    // relasi ke room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranKamar::class, 'user_id', 'user_id');
    }
}
