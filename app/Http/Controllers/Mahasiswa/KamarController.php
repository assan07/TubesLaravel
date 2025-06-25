<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KamarController extends Controller
{
    public function index()
    {
        $kamarLaki = Room::where('jenis_kamar', 'laki-laki');
        $kamarPerempuan = Room::where('jenis_kamar', 'perempuan');

        $data = [
            'laki' => [
                'total' => $kamarLaki->count(),
                'tersedia' => $kamarLaki->where('status', 'tersedia')->count(),
                'diisi' => $kamarLaki->where('status', 'diisi')->count(),
                'maintenance' => $kamarLaki->where('status', 'maintenance')->count(),
            ],
            'perempuan' => [
                'total' => $kamarPerempuan->count(),
                'tersedia' => $kamarPerempuan->where('status', 'tersedia')->count(),
                'diisi' => $kamarPerempuan->where('status', 'diisi')->count(),
                'maintenance' => $kamarPerempuan->where('status', 'maintenance')->count(),
            ],
        ];

        return view('mahasiswa.informasiDataKamar', compact('data'));
    }
}
