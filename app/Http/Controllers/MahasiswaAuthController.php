<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaAuthController extends Controller
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

        return redirect('/')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showLoginForm()
    {
        return view('mahasiswa.loginMahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|string', // field ini bisa berupa email atau nim
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('nim'); // ini bisa NIM atau email
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        $credentials = [
            $loginType => $loginInput,
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/data-kamar'); // sesuaikan dengan tujuan setelah login
        }

        return back()->withErrors([
            'nim' => 'NIM atau Email atau Password salah.',
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
