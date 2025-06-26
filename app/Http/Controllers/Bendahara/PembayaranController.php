<?php

namespace App\Http\Controllers\Bendahara;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        App::setLocale('id');

        // Mapping bulan Indonesia ke English
        $bulanMap = [
            'januari' => 'January',
            'februari' => 'February',
            'maret' => 'March',
            'april' => 'April',
            'mei' => 'May',
            'juni' => 'June',
            'juli' => 'July',
            'agustus' => 'August',
            'september' => 'September',
            'oktober' => 'October',
            'november' => 'November',
            'desember' => 'December',
        ];

        if ($request->has('filter_bulan')) {
            [$bulan, $tahun] = explode('|', $request->input('filter_bulan'));
        } else {
            $now = Carbon::now();
            $bulan = strtolower($now->translatedFormat('F'));
            $tahun = $now->year;
        }

        // Konversi nama bulan Indonesia ke format English agar bisa diparsing Carbon
        $bulanEn = $bulanMap[$bulan] ?? null;
        if (!$bulanEn) {
            abort(400, 'Bulan tidak valid.');
        }

        // Ambil awal bulan dari filter (ex: 2025-06-01)
        $selectedDate = Carbon::createFromFormat('F Y', "$bulanEn $tahun")->startOfMonth();
        $now = Carbon::now()->startOfMonth();

        // Tentukan status default: jika bulan yang difilter == sekarang, maka pending, else terlambat
        $statusDefault = $selectedDate->equalTo($now) ? 'pending' : 'terlambat';

        // Ambil semua penghuni (yang sudah di-approve), gabungkan dengan pembayaran bulan tersebut
        $penghuni = DB::table('pendaftaran_kamars')
            ->join('users', 'pendaftaran_kamars.user_id', '=', 'users.id')
            ->join('rooms', 'pendaftaran_kamars.room_id', '=', 'rooms.id')
            ->leftJoin('pembayarans', function ($join) use ($bulan, $tahun) {
                $join->on('pendaftaran_kamars.user_id', '=', 'pembayarans.user_id')
                    ->where('pembayarans.bulan', '=', $bulan)
                    ->where('pembayarans.tahun', '=', $tahun);
            })
            ->where('pendaftaran_kamars.status_berkas', 'approved')
            ->select(
                'users.nama',
                'users.nim',
                'rooms.nama_kamar',
                'rooms.no_kamar',
                'rooms.lokasi_kamar',
                'pembayarans.harga',
                'pembayarans.status_pembayaran',
                'pembayarans.tanggal_bayar',
                'pembayarans.created_at as pembayaran_created_at',
                DB::raw("
                    CASE 
                        WHEN pembayarans.status_pembayaran IS NOT NULL THEN pembayarans.status_pembayaran
                        ELSE '$statusDefault'
                    END as status_final
                ")
            )
            ->paginate(10);

        // Hitung statistik dari hasil query penghuni
        $statistik = [
            'total_pembayaran' => $penghuni->sum('harga'),
            'lunas' => $penghuni->filter(fn($item) => $item->status_final === 'lunas')->count(),
            'pending' => $penghuni->filter(fn($item) => $item->status_final === 'pending')->count(),
            'terlambat' => $penghuni->filter(fn($item) => $item->status_final === 'terlambat')->count(),
        ];

        return view('bendahara.cekPembayaran', compact('penghuni', 'statistik', 'bulan', 'tahun'));
    }
}
