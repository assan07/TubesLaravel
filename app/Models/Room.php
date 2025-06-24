<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'nama_kamar',
        'no_kamar',
        'lokasi_kamar',
        'jenis_kamar',
        'status'
    ];
    public function pendaftaranKamars()
    {
        return $this->hasMany(PendaftaranKamar::class, 'room_id');
    }
}
