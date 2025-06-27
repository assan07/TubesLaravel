<?php

namespace App\Http\Controllers\Bendahara;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

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
            'users.id as user_id',
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

    public function detail($user_id, $bulan, $tahun)
    {
        App::setLocale('id');

        // Mapping bulan ke angka
        $bulanMap = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12',
        ];

        $bulanLower = strtolower($bulan);
        $bulanAngka = $bulanMap[$bulanLower] ?? null;
        if (!$bulanAngka) {
            abort(400, 'Bulan tidak valid');
        }

        $pembayaran = DB::table('users')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('pendaftaran_kamars', 'users.id', '=', 'pendaftaran_kamars.user_id')
            ->join('rooms', 'pendaftaran_kamars.room_id', '=', 'rooms.id')
            ->leftJoin('pembayarans', function ($join) use ($bulanLower, $tahun) {
                $join->on('users.id', '=', 'pembayarans.user_id')
                    ->where('pembayarans.bulan', '=', $bulanLower)
                    ->where('pembayarans.tahun', '=', $tahun);
            })
            ->where('users.id', $user_id)
            ->where('pendaftaran_kamars.status_berkas', 'approved')
            ->select(
                'users.nama',
                'users.nim',
                'users.email',
                'mahasiswa.phone',
                'rooms.nama_kamar',
                'rooms.no_kamar',
                'rooms.lokasi_kamar',
                DB::raw("IFNULL(rooms.harga, 0) as harga"),
                'pembayarans.tanggal_bayar',
                'pembayarans.jenis_pembayaran',
                DB::raw("IFNULL(pembayarans.status_pembayaran, 'pending') as status_pembayaran")
            )
            ->first();

        if (!$pembayaran) {
            return redirect()->route('pembayaran.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('bendahara.detailPembayaran', [
            'pembayaran' => $pembayaran,
            'bulan' => Str::ucfirst($bulan),
            'tahun' => $tahun,
        ]);
    }

    public function edit($user_id, $bulan, $tahun)
    {
        App::setLocale('id');
        $bulanMap = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12',
        ];
        $bulanAngka = $bulanMap[strtolower($bulan)] ?? null;

        if (!$bulanAngka) abort(400, 'Bulan tidak valid');

        $data = DB::table('pendaftaran_kamars')
            ->join('users', 'pendaftaran_kamars.user_id', '=', 'users.id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('rooms', 'pendaftaran_kamars.room_id', '=', 'rooms.id')
            ->leftJoin('pembayarans', function ($join) use ($bulan, $tahun) {
                $join->on('pembayarans.user_id', '=', 'users.id')
                    ->where('pembayarans.bulan', strtolower($bulan))
                    ->where('pembayarans.tahun', $tahun);
            })
            ->where('pendaftaran_kamars.user_id', $user_id)
            ->select(
                'users.nama',
                'users.nim',
                'users.email',
                'mahasiswa.phone',
                'rooms.nama_kamar',
                'rooms.no_kamar',
                'rooms.lokasi_kamar',
                DB::raw("COALESCE(pembayarans.harga, 0) as harga"),
                'pembayarans.status_pembayaran',
                'pembayarans.tanggal_bayar',
                'pembayarans.jenis_pembayaran'
            )
            ->first();

        if (!$data) {
            return redirect()->route('pembayaran.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('bendahara.editPembayaran', [
            'pembayaran' => $data,
            'bulan' => Str::ucfirst($bulan),
            'tahun' => $tahun,
            'user_id' => $user_id,
        ]);
    }

    public function update(Request $request, $user_id, $bulan, $tahun)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:lunas,pending,terlambat',
        ]);

        $now = Carbon::now();
        $status = $request->status_pembayaran;

        // Ambil harga dari kamar
        $harga = DB::table('pendaftaran_kamars')
            ->join('rooms', 'pendaftaran_kamars.room_id', '=', 'rooms.id')
            ->where('pendaftaran_kamars.user_id', $user_id)
            ->value('rooms.harga'); // Ambil 1 kolom saja

        if (!$harga) {
            return back()->with('error', 'Harga kamar tidak ditemukan.');
        }

        $data = [
            'user_id' => $user_id,
            'bulan' => strtolower($bulan),
            'tahun' => $tahun,
            'status_pembayaran' => $status,
            'harga' => $harga, // default harga, bisa diambil dari room juga
            'tanggal_bayar' => $now->toDateString(),
            'jenis_pembayaran' => $status === 'lunas' ? 'Cash' : 'Non Cash',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // Cek apakah data sudah ada → update atau insert
        $existing = DB::table('pembayarans')
            ->where('user_id', $user_id)
            ->where('bulan', strtolower($bulan))
            ->where('tahun', $tahun)
            ->first();

        if ($existing) {
            unset($data['created_at']);
            DB::table('pembayarans')
                ->where('user_id', $user_id)
                ->where('bulan', strtolower($bulan))
                ->where('tahun', $tahun)
                ->update($data);
        } else {
            DB::table('pembayarans')->insert($data);
        }

        return redirect()->route('pembayaran.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
