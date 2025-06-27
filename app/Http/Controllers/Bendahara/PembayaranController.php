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

        // Redirect jika filter_bulan belum ada
        if (!$request->has('filter_bulan')) {
            $now = Carbon::now();
            $defaultFilter = strtolower($now->translatedFormat('F')) . '|' . $now->year;

            return redirect()->route('pembayaran.index', array_merge(
                $request->query(),
                ['filter_bulan' => $defaultFilter]
            ));
        }

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

        // Ambil bulan dan tahun dari filter
        [$bulan, $tahun] = explode('|', $request->input('filter_bulan'));

        $bulanEn = $bulanMap[$bulan] ?? null;
        if (!$bulanEn) abort(400, 'Bulan tidak valid.');

        $selectedDate = Carbon::createFromFormat('F Y', "$bulanEn $tahun")->startOfMonth();
        $now = Carbon::now()->startOfMonth();
        $statusDefault = $selectedDate->equalTo($now) ? 'pending' : 'terlambat';

        // Ambil nilai pencarian (nama penghuni / kamar)
        $search = $request->input('search');

        $query = DB::table('pendaftaran_kamars')
            ->join('users', 'pendaftaran_kamars.user_id', '=', 'users.id')
            ->join('rooms', 'pendaftaran_kamars.room_id', '=', 'rooms.id')
            ->leftJoin('pembayarans', function ($join) use ($bulan, $tahun) {
                $join->on('pendaftaran_kamars.user_id', '=', 'pembayarans.user_id')
                    ->where('pembayarans.bulan', '=', $bulan)
                    ->where('pembayarans.tahun', '=', $tahun);
            })
            ->where('pendaftaran_kamars.status_berkas', 'approved')
            ->whereMonth('pendaftaran_kamars.tanggal_pendaftaran', '<=', $selectedDate->month)
            ->whereYear('pendaftaran_kamars.tanggal_pendaftaran', '<=', $selectedDate->year);

        // Tambahkan filter pencarian jika ada
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.nama', 'like', "%$search%")
                    ->orWhere('rooms.nama_kamar', 'like', "%$search%");
            });
        }

        $penghuni = $query->select(
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
        )->paginate(10)->appends($request->query());

        // Hitung statistik dari hasil query
        $statistik = [
            'total_pembayaran' => $penghuni->sum('harga'),
            'lunas' => $penghuni->filter(fn($item) => $item->status_final === 'lunas')->count(),
            'pending' => $penghuni->filter(fn($item) => $item->status_final === 'pending')->count(),
            'terlambat' => $penghuni->filter(fn($item) => $item->status_final === 'terlambat')->count(),
        ];

        return view('bendahara.cekPembayaran', compact('penghuni', 'statistik', 'bulan', 'tahun'));
    }
}
