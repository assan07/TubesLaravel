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

        return redirect('/')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showLoginForm($role)
    {
        if (!in_array($role, ['mahasiswa', 'admin', 'bendahara'])) {
            abort(404, 'Not Faund');
        }

        return view('auth.loginAuth', compact('role'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:mahasiswa,admin,bendahara',
        ]);

        $loginInput = $request->input('nim');
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        $credentials = [
            $loginType,
            'password' => $request->password,
            'role' => $request->role
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            // Arahkan ke dashboard sesuai role

             return match ($request->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'bendahara' => redirect()->route('bendahara.dashboard'),
                default => redirect()->route('mahasiswa.dashboard'),
            };
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
