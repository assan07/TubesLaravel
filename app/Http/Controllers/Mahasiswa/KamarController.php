<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KamarController extends Controller
{
    public function index()
    {
        // Ambil query builder (belum dijalankan)
        $queryLaki = Room::where('jenis_kamar', 'laki-laki');
        $queryPerempuan = Room::where('jenis_kamar', 'perempuan');

        // Gunakan clone() agar tidak saling memengaruhi saat dihitung
        $data = [
            'laki' => [
                'total' => (clone $queryLaki)->count(),
                'tersedia' => (clone $queryLaki)->where('status', 'tersedia')->count(),
                'diisi' => (clone $queryLaki)->where('status', 'diisi')->count(),
                'maintenance' => (clone $queryLaki)->where('status', 'maintenance')->count(),
            ],
            'perempuan' => [
                'total' => (clone $queryPerempuan)->count(),
                'tersedia' => (clone $queryPerempuan)->where('status', 'tersedia')->count(),
                'diisi' => (clone $queryPerempuan)->where('status', 'diisi')->count(),
                'maintenance' => (clone $queryPerempuan)->where('status', 'maintenance')->count(),
            ],
        ];

        return view('mahasiswa.informasiDataKamar', compact('data'));
    }
}
