<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Room;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PendaftaranKamar;

use Flasher\Laravel\Facade\Flasher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class PendaftaranKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Ambil kamar yang tersedia
        $rooms = Room::where('status', 'tersedia')->get();

        $pendaftaran = $user->pendaftaranKamar;

        return view('mahasiswa.pendaftaranKamar', compact('pendaftaran', 'rooms', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil kamar yang tersedia
        $rooms = Room::where('status', 'tersedia')->get();

        $pendaftaran = $user->pendaftaranKamar;

        return view('mahasiswa.pendaftaranKamar', compact('pendaftaran', 'rooms', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = Auth::user();
        // Validasi inputan
        $rules = [
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits_between:1,11|unique:pendaftaran_kamars,nim',
            'email' => 'required|email|unique:pendaftaran_kamars,email',
            'no_hp' => 'required|numeric|digits_between:1,13|unique:pendaftaran_kamars,no_hp',
            'prodi' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kamar' => 'required|exists:rooms,id',
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

        if (PendaftaranKamar::where('user_id', $user->id)->exists()) {
            Flasher::addError('Anda sudah mendaftar.');

            return redirect()->back();
        }

        // Simpan data ke database
        PendaftaranKamar::create([
            'user_id' => $user->id,
            'room_id' => $request->kamar,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'prodi' => $request->prodi,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kamar' => $request->kamar,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'status_berkas' => 'pending', // default saat mahasiswa mendaftar
        ]);

        // Tampilkan notifikasi sukses
        Flasher::addSuccess('Pendaftaran kamar berhasil!');

        return redirect()->route('pendaftaran-kamar.index');
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
    public function edit($id)
    {
        $pendaftaran = PendaftaranKamar::findOrFail($id);
        $rooms = Room::all();

        return view('mahasiswa.editBerkasPendaftaran', compact('pendaftaran', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pendaftaran = PendaftaranKamar::findOrFail($id);

        $rules = [
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits_between:1,11|unique:pendaftaran_kamars,nim,' . $id,
            'email' => 'required|email|unique:pendaftaran_kamars,email,' . $id,
            'no_hp' => 'required|numeric|digits_between:1,13|unique:pendaftaran_kamars,no_hp,' . $id,
            'prodi' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'room_id' => 'required|exists:rooms,id', // kolom relasi kamar
            'tanggal_pendaftaran' => 'required|date',
        ];

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.numeric' => 'NIM harus berupa angka.',
            'nim.digits_between' => 'Max NIM adalah 11 digit.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'No. HP wajib diisi.',
            'no_hp.numeric' => 'No. HP harus berupa angka.',
            'no_hp.digits_between' => 'Max No. HP adalah 13 digit.',
            'no_hp.unique' => 'No. HP sudah terdaftar.',
            'prodi.required' => 'Program studi wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'room_id.required' => 'Pilih kamar terlebih dahulu.',
            'room_id.exists' => 'Kamar yang dipilih tidak valid.',
            'tanggal_pendaftaran.required' => 'Tanggal pendaftaran tidak boleh kosong.',
        ];

        $validated = $request->validate($rules, $messages);

        $pendaftaran->update($validated);

        Flasher::addSuccess('Berkas pendaftaran berhasil diperbarui!');
        return redirect()->route('pendaftaran-kamar.index');
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
