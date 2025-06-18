<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;


class MahasiswaController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Convert semester to Roman numeral if it exists from the halper function
        $semesterRomawi = toRomawi($mahasiswa->semester ?? 1);

        return view('mahasiswa.informasiAkunMahasiswa', compact('user', 'mahasiswa'));
    }

    public function showPhotoProfile()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        return view('layouts.mahasiswa.header', compact('user', 'mahasiswa'));
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
        $mahasiswa = Mahasiswa::firstOrNew(['user_id' => $user->id]);

        $mahasiswa->phone = $request->phoneMahasiswa;
        $mahasiswa->prodi = $request->prodiMahasiswa;
        $mahasiswa->gender = $request->paymentCycle;
        $mahasiswa->semester = $request->semesterMahasiswa;
        $mahasiswa->umur = $request->age;
        $mahasiswa->alamat = $request->addressMahasiswa;

        if ($request->hasFile('photo_mahasiswa')) {

            $file = $request->file('photo_mahasiswa');
            $nimMahasiswa = $user->nim;
            $filename = time() . '_' . $nimMahasiswa . '_' . $file->getClientOriginalName();

            // Simpan langsung ke folder public/assets/images/mahasiswa/photoProfile
            $destinationPath = public_path('assets/images/mahasiswa/photoProfile');
            $file->move($destinationPath, $filename);

            $mahasiswa->foto = $filename;
        }

        $mahasiswa->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    // Function to delete the profile photo
    public function deletePhotoProfile()
    {
        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if ($mahasiswa && $mahasiswa->foto) {
                // Delete the photo file from the public directory
                $filePath = public_path('assets/images/mahasiswa/photoProfile/' . $mahasiswa->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Update the mahasiswa record to remove the photo
                $mahasiswa->foto = null;
                $mahasiswa->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Foto profil berhasil dihapus.'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada foto untuk dihapus. (Simpan dulu foto profil Anda sebelum menghapusnya)'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
