<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangedNotification;
use Flasher\Laravel\Facade\Flasher;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.ubahPassword');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user(); // atau pakai ->first() kalau ambil via where

        if ($request->email !== $user->email) {
            return back()->withErrors(['email' => 'Email tidak sesuai akun login.']);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        // Laravel 12: hashing otomatis (atau bisa manual pakai Hash::make)
        $user->update([
            'password' => $request->new_password,
        ]);

        Mail::to($user->email)->send(new PasswordChangedNotification($user));
        Flasher::addSuccess('Password berhasil diubah.');
        return redirect()->back();
    }
}
