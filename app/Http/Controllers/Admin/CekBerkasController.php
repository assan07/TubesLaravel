<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\PendaftaranKamar;
use Flasher\Laravel\Facade\Flasher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\StatusBerkasMail;
use Illuminate\Support\Facades\Mail;

class CekBerkasController extends Controller
{
    public function lakiLaki()
    {
        // Ambil data pendaftar laki-laki
        $pendaftars = PendaftaranKamar::where('jenis_kelamin', 'Laki-laki')->get();

        // Hitung statistik
        $stats = [
            'total' => $pendaftars->count(),
            'approved' => $pendaftars->where('status_berkas', 'approved')->count(),
            'pending' => $pendaftars->where('status_berkas', 'pending')->count(),
            'rejected' => $pendaftars->where('status_berkas', 'rejected')->count(),
        ];

        return view('admin.dataBerkas.kelolaDataBerkasLakilaki', compact('pendaftars', 'stats'));
    }

    public function show($id)
    {
        $data = PendaftaranKamar::with('room')->findOrFail($id);
        return view('admin.dataBerkas.detailBerkasPendaftaranLakilaki', compact('data'));
    }

    // update data berkas

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_berkas' => 'required|in:approved,pending,rejected',
        ]);

        $data = PendaftaranKamar::findOrFail($id);
        $data->status_berkas = $request->status_berkas;
        $data->save();

        // Kirim email notifikasi
        Mail::to($data->email)->queue(new StatusBerkasMail($data));

        Flasher::addSuccess('Status berkas berhasil diperbarui.');
        return redirect()->back();
    }

    // download pdf
    public function unduhBukti($id)
    {
        $data = PendaftaranKamar::with('room')->findOrFail($id);

        $pdf = Pdf::loadView('admin.dataBerkas.bukti_pdf', compact('data'));
        return $pdf->download('Bukti_Pendaftaran_' . $data->nim . '.pdf');
    }
}
