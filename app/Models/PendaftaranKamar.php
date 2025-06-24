<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'no_hp',
        'prodi',
        'jenis_kelamin',
        'kamar',
        'tanggal_pendaftaran',
    ];
}
