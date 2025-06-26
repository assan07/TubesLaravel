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
use App\Models\PendaftaranKamar;

class PembayaranController extends Controller
{
    public function create()
    {
        $user = User::with('pendaftaranKamar.room')->findOrFail(Auth::id());

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $pendaftaran = $user->pendaftaranKamar;

        // ✅ Cek apakah mahasiswa sudah punya kamar
        if (!$pendaftaran || !$pendaftaran->room || !$pendaftaran->room->nama_kamar) {
            Flasher::addError('Anda belum memiliki kamar. Silakan lakukan pendaftaran kamar terlebih dahulu.');
            return redirect()->back();
        }

        $harga = optional($pendaftaran->room)->harga ?? 0;

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

        return view('mahasiswa.pembayaranKamar', compact('user', 'mahasiswa', 'harga', 'bulanList', 'pendaftaran'));
    }


    public function paymentWhitMidtrans(Request $request)
    {
        $user = Auth::user();
        $bulan = $request->bulan;

        if (!$bulan) {
            return back()->with('error', 'Bulan pembayaran wajib dipilih.');
        }

        // Ambil data pendaftaran kamar + relasi room
        $pendaftaran = PendaftaranKamar::with('room')->where('user_id', $user->id)->first();

        if (!$pendaftaran) {
            Flasher::addError('Silahkan daftar kamar terlebih dahulu sebelum melakukan pembayaran.');
            return back();
        }

        if ($pendaftaran->status_berkas !== 'approved') {
            Flasher::addError('Status berkas Anda belum disetujui oleh admin. Pembayaran belum bisa dilakukan.');
            return back();
        }

        $harga = optional($pendaftaran->room)->harga;

        if (!$harga || $harga <= 0) {
            Flasher::addError('Harga kamar belum ditentukan. Silahkan hubungi admin.');
            return back();
        }

        // Cek pembayaran duplikat
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
            'status_pembayaran' => 'lunas', // ✅ harus cocok dengan enum
            'jenis_pembayaran' => 'Non Cash',
            'harga' => (int) $result['gross_amount'], // casting ke integer kalau perlu
        ]);

        return response()->json(['message' => 'Pembayaran berhasil disimpan.']);
    }


    // ✅ Menampilkan riwayat pembayaran mahasiswa
    public function riwayat()
    {
        $bulanList = [
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
        $user = Auth::user();

        $riwayat = Pembayaran::with(['user.pendaftaranKamar.room']) // include relasi sampai ke room
            ->where('user_id', $user->id)
            ->orderByDesc('tanggal_bayar')
            ->get();

        return view('mahasiswa.riwayatPembayaran', compact('riwayat', 'bulanList'));
    }
}
