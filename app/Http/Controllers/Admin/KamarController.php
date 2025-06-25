<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KamarController extends Controller
{
    // ✅ Halaman dashboard kelola data kamar
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

    // ✅ Tampilkan form tambah kamar
    public function create()
    {
        return view('admin.dataKamar.formDataKamar'); // Tidak ada variabel $kamar dikirim
    }

    // ✅ Simpan data kamar baru
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

        Room::create($request->all());

        return redirect('/kelola-data-kamar')->with('success', 'Data kamar berhasil disimpan.');
    }

    // ✅ Tampilkan kamar berdasarkan jenis: laki-laki / perempuan
    public function indexByJenis($jenis_kamar)
    {
        $kamarList = Room::where('jenis_kamar', $jenis_kamar)->get();

        // Hitung data berdasarkan jenis_kamar yang sama
        $data = [
            'total' => $kamarList->count(),
            'tersedia' => $kamarList->where('status', 'tersedia')->count(),
            'diisi' => $kamarList->where('status', 'diisi')->count(),
            'maintenance' => $kamarList->where('status', 'maintenance')->count(),
        ];

        return view('admin.dataKamar.dataKamarJenis', compact('kamarList', 'jenis_kamar', 'data'));
    }

    // ✅ Tampilkan detail kamar
    public function show($jenis_kamar, $id)
    {
        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        return view('admin.dataKamar.detailDataKamar', compact('kamar'));
    }

    // ✅ Tampilkan form edit kamar (pakai view yang sama dengan create)
    public function edit($jenis_kamar, $id)
    {
        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        return view('admin.dataKamar.formKamar', compact('kamar'));
    }

    // ✅ Update data kamar
    public function update(Request $request, $jenis_kamar, $id)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'no_kamar' => 'required|string|max:50|unique:rooms,no_kamar,' . $id,
            'lokasi_kamar' => 'required|string|max:255',
            'harga' => 'required|string',
            'status' => 'required|in:tersedia,diisi,maintenance',
        ]);

        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        $kamar->update($request->all());

        return redirect("/kelola-data-kamar/data-kamar/$jenis_kamar")->with('success', 'Data kamar berhasil diperbarui.');
    }

    // ✅ Hapus kamar
    public function destroy($jenis_kamar, $id)
    {
        $kamar = Room::where('jenis_kamar', $jenis_kamar)->findOrFail($id);
        $kamar->delete();

        return redirect("/kelola-data-kamar/data-kamar/$jenis_kamar")->with('success', 'Data kamar berhasil dihapus.');
    }

    // ✅ Pencarian kamar (jika nanti mau diaktifkan)
    public function search(Request $request)
    {
        $search = $request->input('search');

        $filteredRooms = Room::where('nama_kamar', 'like', "%{$search}%")->get();

        $data = [
            'laki' => [
                'total' => $filteredRooms->where('jenis_kamar', 'laki-laki')->count(),
                'tersedia' => $filteredRooms->where('jenis_kamar', 'laki-laki')->where('status', 'tersedia')->count(),
                'diisi' => $filteredRooms->where('jenis_kamar', 'laki-laki')->where('status', 'diisi')->count(),
                'maintenance' => $filteredRooms->where('jenis_kamar', 'laki-laki')->where('status', 'maintenance')->count(),
            ],
            'perempuan' => [
                'total' => $filteredRooms->where('jenis_kamar', 'perempuan')->count(),
                'tersedia' => $filteredRooms->where('jenis_kamar', 'perempuan')->where('status', 'tersedia')->count(),
                'diisi' => $filteredRooms->where('jenis_kamar', 'perempuan')->where('status', 'diisi')->count(),
                'maintenance' => $filteredRooms->where('jenis_kamar', 'perempuan')->where('status', 'maintenance')->count(),
            ],
        ];

        return view('admin.dataKamar.kelolaDataKamar', compact('data'));
    }
}
