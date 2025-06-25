<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Ambil harga dari salah satu record di tabel rooms (asumsi semua kamar harganya sama)
        $harga = \App\Models\Room::value('harga'); // ambil nilai 'harga' dari 1 record pertama

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


    public function PaymentWhitMidtrans(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->bulan;

        // Ambil harga dari salah satu record Room
        $harga = \App\Models\Room::value('harga');

        // ✅ VALIDASI: Cek apakah user sudah membayar untuk bulan ini
        $existing = Pembayaran::where('user_id', $user->id)
            ->where('bulan', $bulan)
            ->where('tahun', date('Y'))
            ->first();

        if ($existing) {
            // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
            return back()->with('error', 'Kamu sudah membayar untuk bulan ' . ucfirst($bulan) . '.');
        }

        // Buat unique order ID
        $orderId = 'ORDER-' . time();

        // Siapkan parameter untuk Midtrans
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

        // Buat Snap Token Midtrans
        $snap = MidtransService::createTransaction($params);

        // Kirim token ke view
        return view('mahasiswa.snap', [
            'snapToken' => $snap->token,
            'orderId' => $orderId,
            'bulan' => $bulan,
            'harga' => $harga
        ]);
    }


    public function PaymentSucces(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        // Validasi minimal data yang dibutuhkan
        if (!isset($data['midtrans_result']) || !isset($data['bulan'])) {
            return response()->json(['error' => 'Data tidak lengkap'], 400);
        }

        $result = $data['midtrans_result'];

        // Cek jika status transaksi berhasil
        if (($result['transaction_status'] ?? '') !== 'settlement') {
            return response()->json(['error' => 'Transaksi belum berhasil diselesaikan'], 422);
        }

        // Simpan ke tabel pembayaran
        Pembayaran::create([
            'user_id' => $user->id,
            'bulan' => $data['bulan'],
            'tahun' => date('Y'),
            'tanggal_bayar' => $data['midtrans_result']['transaction_time'],
            'status' => 'sudah',
            'jenis_pembayaran' => 'Non Cash',
            'harga' => $data['midtrans_result']['gross_amount']
        ]);

        return response()->json(['message' => 'Pembayaran berhasil disimpan.']);
    }
}
