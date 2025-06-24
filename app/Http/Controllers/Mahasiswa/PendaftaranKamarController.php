<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\PendaftaranKamar;
use App\Http\Controllers\Controller;
use Flasher\Laravel\Facade\Flasher;

class PendaftaranKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pendaftarans = PendaftaranKamar::latest()->get();
        return view('mahasiswa.pendaftaranKamar');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('pendaftaran_kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // try {
        // Validasi inputan
        $rules = [
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits_between:1,11|unique:pendaftaran_kamars,nim',
            'email' => 'required|email|unique:pendaftaran_kamars,email',
            'no_hp' => 'required|numeric|digits_between:1,13|unique:pendaftaran_kamars,no_hp',
            'prodi' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kamar' => 'required|string|max:50',
            'tanggal_pendaftaran' => 'required|date',
        ];

        $messages = [
            // Custom messages
            'nama.required' => 'Nama wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.numeric' => 'NIM harus berupa angka',
            'nim.digits_between' => 'Max NIM adalah 11 digit',
            'nim.unique' => 'NIM sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'No. HP wajib diisi.',
            'no_hp.numeric' => 'No.Hp harus berupa angka',
            'no_hp.digits_between' => 'Max No. Hp adalah 13 digits',
            'no_hp.unique' => 'No.Hp sudah terdaftar.',
            'prodi.required' => 'Program studi wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'kamar.required' => 'Pilih kamar terlebih dahulu.',
            'tanggal_pendaftaran.required' => 'Tanggal pendaftaran tidak boleh kosong.',
        ];
        $request->validate($rules, $messages);

        // Simpan data ke database
        PendaftaranKamar::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'prodi' => $request->prodi,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kamar' => $request->kamar,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        // Tampilkan notifikasi sukses
        Flasher::addSuccess('Pendaftaran kamar berhasil!');

        return redirect()->route('pendaftaran-kamar.index');
        // } catch (\Exception $e) {
        //     // Jika ada error selain validasi, tampilkan notifikasi error
        //     Flasher::addError('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');

        //     return back()->withInput(); // balikin input sebelumnya
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(PendaftaranKamar $pendaftaran_kamar)
    {
        return view('pendaftaran_kamar.show', compact('pendaftaran_kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendaftaranKamar $pendaftaran_kamar)
    {
        return view('pendaftaran_kamar.edit', compact('pendaftaran_kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendaftaranKamar $pendaftaran_kamar)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:pendaftaran_kamars,nim,' . $pendaftaran_kamar->id,
            'email' => 'required|email|unique:pendaftaran_kamars,email,' . $pendaftaran_kamar->id,
            'noHp' => 'required|string|max:15',
            'prodi' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kamar' => 'required|string|max:50',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $pendaftaran_kamar->update([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'no_hp' => $validated['noHp'],
            'prodi' => $validated['prodi'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'kamar' => $validated['kamar'],
            'tanggal_pendaftaran' => $validated['tanggal_pendaftaran'],
        ]);

        return redirect()->route('pendaftaran-kamar.index')->with('success', 'Data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftaranKamar $pendaftaran_kamar)
    {
        $pendaftaran_kamar->delete();
        return redirect()->route('pendaftaran-kamar.index')->with('success', 'Data dihapus.');
    }
}
