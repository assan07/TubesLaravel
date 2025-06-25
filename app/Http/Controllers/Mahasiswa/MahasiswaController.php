<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\GlobalHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

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
        $rules = [
            'phoneMahasiswa' => 'nullable|numeric|digits_between:12,13',
            'prodiMahasiswa' => 'nullable|string',
            'gender' => 'nullable|in:lakilaki,perempuan',
            'semesterMahasiswa' => 'nullable|integer',
            'age' => 'nullable|integer|min:1|max:100',
            'addressMahasiswa' => 'nullable|string|min:5',
            'photo_mahasiswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'phoneMahasiswa.numeric' => 'Nomor handphone harus berupa angka.',
            'phoneMahasiswa.digits_between' => 'Nomor handphone harus terdiri dari 12 sampai 13 digit.',

            'prodiMahasiswa.string' => 'Program studi harus berupa teks.',

            'gender.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan.',

            'semesterMahasiswa.integer' => 'Semester harus berupa angka.',

            'age.integer' => 'Umur harus berupa angka.',
            'age.min' => 'Umur minimal 1 tahun.',
            'age.max' => 'Umur maksimal 100 tahun.',

            'addressMahasiswa.string' => 'Alamat harus berupa teks.',
            'addressMahasiswa.min' => 'Alamat minimal 5 karakter.',

            'photo_mahasiswa.image' => 'File harus berupa gambar.',
            'photo_mahasiswa.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'photo_mahasiswa.max' => 'Ukuran gambar maksimal 2MB.',
        ];


        $request->validate($rules, $messages);


        $user = Auth::user();
        $mahasiswa = Mahasiswa::firstOrNew(['user_id' => $user->id]);

        $mahasiswa->phone = $request->phoneMahasiswa;
        $mahasiswa->prodi = $request->prodiMahasiswa;
        $mahasiswa->gender = $request->gender;
        $mahasiswa->semester = $request->semesterMahasiswa;
        $mahasiswa->umur = $request->age;
        $mahasiswa->alamat = $request->addressMahasiswa;

        // Hapus foto lama jika ada dan user upload foto baru
        if ($request->hasFile('photo_mahasiswa')) {
            if ($mahasiswa->foto && Storage::exists($mahasiswa->foto)) {
                Storage::delete($mahasiswa->foto); // Hapus file lama
            }

            $file = $request->file('photo_mahasiswa')->store('mahasiswa/profileMahasiswa');
            $mahasiswa->foto = $file;
        }

        $mahasiswa->save();

        Flasher::addSuccess('Data berhasil disimpan!');
        return redirect()->back();
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
