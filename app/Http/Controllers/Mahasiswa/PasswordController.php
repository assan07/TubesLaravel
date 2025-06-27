<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;

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
        $rules = [
            'email' => 'required|email',
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka

            ],
        ];

        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.current_mail' => 'Email anda salah',
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'new_password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka.',
        ];

        $request->validate($rules, $messages);

        /** @var \App\Models\User $user */
        $user = Auth::user();


        if (!$user) {
            return back()->withErrors(['user' => 'User tidak ditemukan.']);
        }

        if ($request->email !== $user->email) {
            return back()->withErrors(['email' => 'Email tidak sesuai dengan akun login.']);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = $request->new_password;
        $user->save();

        try {
            Mail::to($user->email)->send(new PasswordChangedNotification($user));
        } catch (\Exception $e) {
            return back()->withErrors(['mail' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }

        Flasher::addSuccess('Password berhasil diubah.');
        return redirect()->route('password.edit');
    }
}
