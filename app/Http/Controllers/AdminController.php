<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Laravel\Facade\Flasher;

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
        Flasher::addSuccess('Akun berhasil di-approve!');
        return back()->with('success');
    }

    public function pendingAkun($id)
    {
        User::where('id', $id)->update(['is_approved' => false]);

        Flasher::addSuccess('Akun diset ke pending.');

        return back()->with('success');
    }

    public function rejectAkun($id)
    {
        User::destroy($id);
        
        Flasher::addSuccess('Akun berhasil dihapus!');
        return back()->with('success');
    }
}
