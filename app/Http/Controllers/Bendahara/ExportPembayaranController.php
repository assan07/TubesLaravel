<?php

namespace App\Http\Controllers\Bendahara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ExportPembayaranController extends Controller
{
    public function exportExcel(Request $request)
    {
        return Excel::download(new PembayaranExport($request), 'data_pembayaran.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $data = (new PembayaranExport($request))->collection();

        $filter = explode('|', $request->input('filter_bulan', ''));

        $bulanMap = [
            'januari' => 'Januari',
            'februari' => 'Februari',
            'maret' => 'Maret',
            'april' => 'April',
            'mei' => 'Mei',
            'juni' => 'Juni',
            'juli' => 'Juli',
            'agustus' => 'Agustus',
            'september' => 'September',
            'oktober' => 'Oktober',
            'november' => 'November',
            'desember' => 'Desember',
        ];

        $bulanKey = strtolower($filter[0] ?? '');
        $bulanLabel = $bulanMap[$bulanKey] ?? '-';
        $tahun = $filter[1] ?? '-';

        $periode = "$bulanLabel $tahun";


        $pdf = PDF::loadView('bendahara.pembayaran_pdf', [
            'data' => $data,
            'periode' => $periode,
        ]);

        return $pdf->download('data_pembayaran.pdf');
    }
}
