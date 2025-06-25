<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PendaftaranKamar;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusBerkasMail;
use Flasher\Laravel\Facade\Flasher;

class CekBerkasController extends Controller
{
    public function indexAll()
    {
        $pendaftarLaki = PendaftaranKamar::where('jenis_kelamin', 'Laki-laki');
        $pendaftarPerempuan = PendaftaranKamar::where('jenis_kelamin', 'Perempuan');

        $stats = [
            'laki' => [
                'total' => $pendaftarLaki->count(),
                'approved' => $pendaftarLaki->where('status_berkas', 'approved')->count(),
            ],
            'perempuan' => [
                'total' => $pendaftarPerempuan->count(),
                'approved' => $pendaftarPerempuan->where('status_berkas', 'approved')->count(),
            ],
        ];

        // Ambil 5 data terbaru gabungan
        $latest = PendaftaranKamar::latest()->take(5)->get();

        return view('admin.dataBerkas.kelolaDataBerkasAll', compact('stats', 'latest'));
    }


    public function showByGender($gender)
    {
        if (!in_array($gender, ['Laki-laki', 'Perempuan'])) {
            abort(404);
        }

        $pendaftars = PendaftaranKamar::where('jenis_kelamin', $gender)->get();

        $stats = [
            'total' => $pendaftars->count(),
            'approved' => $pendaftars->where('status_berkas', 'approved')->count(),
            'pending' => $pendaftars->where('status_berkas', 'pending')->count(),
            'rejected' => $pendaftars->where('status_berkas', 'rejected')->count(),
        ];

        return view('admin.dataBerkas.kelolaDataBerkasLP', compact('pendaftars', 'stats', 'gender'));
    }

    public function show($id)
    {
        $data = PendaftaranKamar::with('room')->findOrFail($id);
        $gender = $data->jenis_kelamin;
        return view('admin.dataBerkas.detailBerkasPendaftaran', compact('data', 'gender'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_berkas' => 'required|in:approved,pending,rejected',
        ]);

        $data = PendaftaranKamar::findOrFail($id);
        $data->status_berkas = $request->status_berkas;
        $data->save();

        if ($data->room_id) {
            $room = Room::find($data->room_id);
            if ($room) {
                $room->status = $request->status_berkas === 'approved' ? 'diisi' : 'tersedia';
                $room->save();
            }
        }

        Mail::to($data->email)->queue(new StatusBerkasMail($data));

        Flasher::addSuccess('Status berkas berhasil diperbarui.');
        return redirect()->back();
    }

    public function unduhBukti($id)
    {
        $data = PendaftaranKamar::with('room')->findOrFail($id);
        $pdf = Pdf::loadView('admin.dataBerkas.bukti_pdf', compact('data'));
        return $pdf->download('Bukti_Pendaftaran_' . $data->nim . '.pdf');
    }

    public function destroy($id)
    {
        $data = PendaftaranKamar::findOrFail($id);

        if ($data->status_berkas === 'approved' && $data->room_id) {
            $room = Room::find($data->room_id);
            if ($room) {
                $room->status = 'tersedia';
                $room->save();
            }
        }

        $gender = $data->jenis_kelamin;
        $data->delete();

        Flasher::addSuccess('Berkas pendaftaran berhasil dihapus.');
        return redirect()->route('admin.berkas.byGender', ['gender' => $gender]);
    }
}
