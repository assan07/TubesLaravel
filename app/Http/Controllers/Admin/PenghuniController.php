<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::whereHas('pendaftaranKamar', function ($q) {
            $q->where('status_berkas', 'approved'); // hanya yang sudah disetujui admin
        })
            ->with(['pendaftaranKamar' => function ($q) {
                $q->where('status_berkas', 'approved');
            }, 'pendaftaranKamar.room']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $users = $query->get();

        return view('admin.dataPenghuni.kelolaDataPenghuni', compact('users'));
    }

    public function edit($id)
    {
        $user = User::with(['pendaftaranKamar.room'])->findOrFail($id);
        $rooms = Room::all(); // Untuk dropdown pilih kamar
        return view('admin.dataPenghuni.editDataPenghuni', compact('user', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $user = User::findOrFail($id);

        if ($user->pendaftaranKamar) {
            $user->pendaftaranKamar->room_id = $request->room_id;
            $user->pendaftaranKamar->save();
        }

        return redirect('/penghuni')->with('success', 'Kamar penghuni berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus data pendaftaran kamar jika ada
        if ($user->pendaftaranKamar) {
            $room = $user->pendaftaranKamar->room;

            // Ubah status kamar menjadi "tersedia" jika ada
            if ($room) {
                $room->status = 'tersedia';
                $room->save();
            }

            // Hapus data pendaftaran kamar
            $user->pendaftaranKamar->delete();
        }

        return redirect('/penghuni')->with('success', 'Data penghuni berhasil dihapus dari kamar.');
    }
}
