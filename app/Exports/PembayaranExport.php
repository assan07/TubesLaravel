<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PembayaranExport implements FromCollection, WithHeadings, WithCustomStartCell, WithEvents
{
    protected $request;
    public $bulan;
    public $tahun;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        App::setLocale('id'); // Pastikan bahasa Indonesia digunakan

        $request = $this->request;

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

        // Ambil bulan dan tahun
        if ($request->has('filter_bulan') && str_contains($request->input('filter_bulan'), '|')) {
            [$bulan, $tahun] = explode('|', $request->input('filter_bulan'));
            $bulan = strtolower($bulan);
        } else {
            $now = Carbon::now();
            $bulan = strtolower($now->locale('id')->translatedFormat('F'));
            $tahun = $now->year;
        }

        // Simpan ke properti agar bisa digunakan di headings()
        $this->bulan = ucfirst($bulan); // kapitalisasi awal
        $this->tahun = $tahun;

        if (!isset($bulanMap[$bulan])) {
            Log::error('Bulan tidak ditemukan dalam bulanMap', ['bulan' => $bulan]);
            abort(400, 'Format bulan tidak valid.');
        }

        $bulanEn = $bulanMap[$bulan];
        $selectedDate = Carbon::createFromFormat('F Y', "$bulanEn $tahun")->startOfMonth();
        $now = Carbon::now()->startOfMonth();
        $statusDefault = $selectedDate->equalTo($now) ? 'pending' : 'terlambat';
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

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.nama', 'like', "%$search%")
                    ->orWhere('rooms.nama_kamar', 'like', "%$search%");
            });
        }

        return $query->select(
            'users.nama',
            'users.nim',
            'rooms.nama_kamar',
            'rooms.no_kamar',
            'rooms.lokasi_kamar',
            DB::raw("IFNULL(pembayarans.harga, 0) as harga"),
            DB::raw("IFNULL(pembayarans.status_pembayaran, '$statusDefault') as status")
        )->get();
    }

    public function startCell(): string
    {
        return 'A2'; // Data mulai dari baris ke-2
    }


    public function headings(): array
    {
        return ['Nama', 'NIM', 'Nama Kamar', 'No Kamar', 'Lokasi', 'Harga', 'Status Pembayaran'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setCellValue('A1', 'Periode: ' . $this->bulan . ' ' . $this->tahun);
                $event->sheet->mergeCells('A1:G1'); // Sesuaikan jumlah kolom
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
            },
        ];
    }
}
