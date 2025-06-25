<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.dataKamar.kelolaDataKamar', compact('data'));
    }

    public function create()
    {
        return view('admin.dataKamar.tambahKamar'); // Ganti sesuai nama file blade kamu
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'no_kamar' => 'required|string|max:50|unique:rooms,no_kamar',
            'lokasi_kamar' => 'required|string|max:255',
            'jenis_kamar' => 'required|in:laki-laki,perempuan',
            'harga' => 'required|string',
            'status' => 'required|in:tersedia,diisi,maintenance',
        ]);

        Room::create([
            'nama_kamar' => $request->nama_kamar,
            'no_kamar' => $request->no_kamar,
            'lokasi_kamar' => $request->lokasi_kamar,
            'jenis_kamar' => $request->jenis_kamar,
            'harga' => $request->harga,
            'status' => $request->status,
        ]);

        return redirect('/kelola-data-kamar')->with('success', 'Data kamar berhasil disimpan.');
    }

    public function indexByJenis($jenis_kamar)
    {
        if ($jenis_kamar === 'laki-laki') {
            $kamarLaki = Room::where('jenis_kamar', 'laki-laki')->get();
            return view('admin.dataKamar.dataKamarLakilaki', [
                'kamarLaki' => $kamarLaki,
                'jenis_kamar' => $jenis_kamar,
            ]);
        } elseif ($jenis_kamar === 'perempuan') {
            $kamarPerempuan = Room::where('jenis_kamar', 'perempuan')->get();
            return view('admin.dataKamar.dataKamarPerempuan', [
                'kamarPerempuan' => $kamarPerempuan,
                'jenis_kamar' => $jenis_kamar,
            ]);
        } else {
            abort(404);
        }
    }

    public function show($jenis_kamar, $id)
    {
        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);

        if ($jenis_kamar === 'laki-laki') {
            return view('admin.dataKamar.detailDataKamarLakilaki', compact('kamar'));
        } elseif ($jenis_kamar === 'perempuan') {
            return view('admin.dataKamar.detailDataKamarPerempuan', compact('kamar'));
        } else {
            abort(404);
        }
    }

    public function edit($jenis_kamar, $id)
    {
        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);

        if ($jenis_kamar === 'laki-laki') {
            return view('admin.dataKamar.editDataKamarLakilaki', compact('kamar'));
        } elseif ($jenis_kamar === 'perempuan') {
            return view('admin.dataKamar.editDataKamarPerempuan', compact('kamar'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $jenis_kamar, $id)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'no_kamar' => 'required|string|max:50|unique:rooms,no_kamar,' . $id,
            'lokasi_kamar' => 'required|string|max:255',
            'status' => 'required|in:tersedia,diisi,maintenance',
        ]);

        $room = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        $room->update($request->all());

        return redirect("/kelola-data-kamar/data-kamar/$jenis_kamar")->with('success', 'Data kamar berhasil diperbarui.');
    }

    public function destroy($jenis_kamar, $id)
    {
        $room = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        $room->delete();

        return redirect("/kelola-data-kamar/data-kamar/$jenis_kamar")->with('success', 'Data kamar berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $rooms = Room::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_kamar', 'like', "%{$search}%");
            })
            ->get();

        // Hitung data per gender
        $data = [
            'laki' => [
                'total' => $rooms->where('jenis_kelamin', 'laki-laki')->count(),
                'tersedia' => $rooms->where('jenis_kelamin', 'laki-laki')->where('status', 'tersedia')->count(),
                'diisi' => $rooms->where('jenis_kelamin', 'laki-laki')->where('status', 'diisi')->count(),
                'maintenance' => $rooms->where('jenis_kelamin', 'laki-laki')->where('status', 'maintenance')->count(),
            ],
            'perempuan' => [
                'total' => $rooms->where('jenis_kelamin', 'perempuan')->count(),
                'tersedia' => $rooms->where('jenis_kelamin', 'perempuan')->where('status', 'tersedia')->count(),
                'diisi' => $rooms->where('jenis_kelamin', 'perempuan')->where('status', 'diisi')->count(),
                'maintenance' => $rooms->where('jenis_kelamin', 'perempuan')->where('status', 'maintenance')->count(),
            ],
        ];

        return view('admin.informasi-data-kamar', compact('data'));
    }
}
