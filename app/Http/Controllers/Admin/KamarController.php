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

    public function indexByJenis(Request $request, $jenis_kamar)
    {
        // Mulai query
        $query = Room::where('jenis_kamar', $jenis_kamar);

        // Filter Berdasrkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan nama kamar jika ada
        if ($request->filled('search')) {
            $query->where('nama_kamar', $request->search);
        }

        // Ambil hasil filter
        $kamarList = $query->get();

        // Untuk dropdown list kamar (ambil semua tanpa filter)
        $allKamar = Room::where('jenis_kamar', $jenis_kamar)->get();

        // Statistik (dari semua kamar jenis ini, tanpa filter search)
        $data = [
            'total' => $allKamar->count(),
            'tersedia' => $allKamar->where('status', 'tersedia')->count(),
            'diisi' => $allKamar->where('status', 'diisi')->count(),
            'maintenance' => $allKamar->where('status', 'maintenance')->count(),
        ];

        // List dropdown kamar unik
        $namaKamarList = $allKamar->pluck('nama_kamar')->unique()->sort();

        return view('admin.dataKamar.dataKamarJenis', [
            'kamarList' => $kamarList,
            'data' => $data,
            'jenis_kamar' => $jenis_kamar,
            'namaKamarList' => $namaKamarList,
        ]);
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
        return view('admin.dataKamar.formDataKamar', compact('kamar'));
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

        return view('admin.dataKamar.dataKamarJenis', compact('data'));
    }
}
