<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransService;

use App\Models\User;
use App\Models\Room;
use App\Models\Mahasiswa;
use App\Models\Pembayaran;
use Flasher\Laravel\Facade\Flasher;

class PembayaranController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // Ambil data mahasiswa (boleh null jika belum isi)
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Ambil harga salah satu kamar, fallback ke 0 jika tidak ada data
        $harga = Room::value('harga') ?? 0;

        $bulanList = [
            'januari',
            'februari',
            'maret',
            'april',
            'mei',
            'juni',
            'juli',
            'agustus',
            'september',
            'oktober',
            'november',
            'desember'
        ];

        return view('mahasiswa.pembayaranKamar', compact('user', 'mahasiswa', 'harga', 'bulanList'));
    }

    public function paymentWhitMidtrans(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->bulan;

        // Validasi input
        if (!$bulan) {
            return back()->with('error', 'Bulan pembayaran wajib dipilih.');
        }

        // Ambil harga dari salah satu record Room
        $harga = \App\Models\Room::value('harga');

        // ✅ VALIDASI harga harus ada dan lebih dari 0
        if (!$harga || $harga <= 0) {
            Flasher::addError('Harga Belum Ditentukan');
            return back();
        }

        // Cek duplikasi pembayaran
        $existing = Pembayaran::where('user_id', $user->id)
            ->where('bulan', $bulan)
            ->where('tahun', date('Y'))
            ->first();

        if ($existing) {
            Flasher::addError('Kamu sudah membayar untuk bulan ' . ucfirst($bulan) . '.');
            return back();
        }

        $orderId = 'ORDER-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $harga,
            ],
            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'bayar-kamar',
                    'price' => $harga,
                    'quantity' => 1,
                    'name' => 'Pembayaran Kamar Bulan ' . ucfirst($bulan),
                ],
            ],
        ];

        $snap = MidtransService::createTransaction($params);

        return view('mahasiswa.snap', [
            'snapToken' => $snap->token,
            'orderId' => $orderId,
            'bulan' => $bulan,
            'harga' => $harga,
        ]);
    }

    public function PaymentSucces(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if (!isset($data['midtrans_result'], $data['bulan'])) {
            return response()->json(['error' => 'Data tidak lengkap.'], 400);
        }

        $result = $data['midtrans_result'];

        if (($result['transaction_status'] ?? '') !== 'settlement') {
            return response()->json(['error' => 'Transaksi belum berhasil diselesaikan.'], 422);
        }

        Pembayaran::create([
            'user_id' => $user->id,
            'bulan' => $data['bulan'],
            'tahun' => date('Y'),
            'tanggal_bayar' => $result['transaction_time'],
            'status' => 'sudah',
            'jenis_pembayaran' => 'Non Cash',
            'harga' => $result['gross_amount'],
        ]);

        return response()->json(['message' => 'Pembayaran berhasil disimpan.']);
    }
}
