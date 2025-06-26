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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaranKamar()
    {
        return $this->hasOne(PendaftaranKamar::class, 'user_id');
    }

}
