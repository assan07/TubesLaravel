<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function kelolaAkun()
    {
        $users = User::all(); // Atau filter by role jika perlu
        return view('admin.dataAkun.kelolaDataAkun', compact('users'));
    }

    public function approveAkun($id)
    {
        User::where('id', $id)->update(['is_approved' => true]);
        return back()->with('success', 'Akun berhasil di-approve.');
    }

    public function pendingAkun($id)
    {
        User::where('id', $id)->update(['is_approved' => false]);
        return back()->with('success', 'Akun diset ke pending.');
    }

    public function rejectAkun($id)
    {
        User::destroy($id);
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
