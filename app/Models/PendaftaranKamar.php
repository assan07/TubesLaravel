<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'nama',
        'nim',
        'email',
        'no_hp',
        'prodi',
        'jenis_kelamin',
        'tanggal_pendaftaran',
        'status_berkas',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
}
