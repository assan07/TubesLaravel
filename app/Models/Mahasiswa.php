<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'user_id',
        'phone',
        'prodi',
        'gender',
        'semester',
        'umur',
        'alamat',
        'foto'
    ];
// relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // relasi ke pendaftran kamar
    public function pendaftaranKamar()
    {
        return $this->hasOne(PendaftaranKamar::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
