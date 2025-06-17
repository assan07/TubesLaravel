<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.informasiAkunMahasiswa', compact('user', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phoneMahasiswa' => 'required|string',
            'prodiMahasiswa' => 'required|string',
            'paymentCycle' => 'required|in:lakilaki,perempuan',
            'semesterMahasiswa' => 'required|integer',
            'age' => 'nullable|integer',
            'addressMahasiswa' => 'required|string',
            'photo_mahasiswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Cek apakah sudah ada data mahasiswa
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Jika belum ada, buat baru
        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->user_id = $user->id;
        }

        // Set/update data mahasiswa
        $mahasiswa->phone = $request->phoneMahasiswa;
        $mahasiswa->prodi = $request->prodiMahasiswa;
        $mahasiswa->gender = $request->paymentCycle;
        $mahasiswa->semester = $request->semesterMahasiswa;
        $mahasiswa->umur = $request->age;
        $mahasiswa->alamat = $request->addressMahasiswa;

        if ($request->hasFile('photo_mahasiswa')) {
            $file = $request->file('photo_mahasiswa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_mahasiswa', $filename, 'public');
            $mahasiswa->foto = $filename;
        }

        $mahasiswa->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
