<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('mahasiswa.registerMahasiswa');
    }

    public function register(Request $request)
    {

        $rules = [
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:8|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'terms' => 'required|accepted',
        ];

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',

            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 8 karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ];

        $request->validate($rules, $messages);


        User::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success');
    }

    public function showLoginForm()
    {
        return view('auth.loginAuth');
    }


    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan apakah input berupa email atau NIM
        $loginInput = $request->input('nim');
        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        // Siapkan kredensial login
        $credentials = [
            $loginField => $loginInput,
            'password' => $request->password,
        ];

        // Proses autentikasi
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Cek apakah user sudah diapprove
            if (!$user->is_approved) {
                Auth::logout();

                // Tambahkan notifikasi flash
                return back()
                    ->with('error', 'Akun Anda belum disetujui oleh admin.')
                    ->withInput($request->only('nim'));
            }

            // Arahkan berdasarkan role
            return match ($user->role) {
                'admin' => redirect('/kelola-data-kamar'),
                'bendahara' => redirect('/cek-pembayaran'),
                'mahasiswa' => redirect('/data-kamar'),
                default => redirect('/'),
            };
        }

        // Autentikasi gagal
        return back()->withErrors([
            'nim' => 'NIM/Email atau password salah.',
        ])->withInput($request->only('nim'));
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
