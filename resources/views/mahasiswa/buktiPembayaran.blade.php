<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Bukti Pembayaran Asrama</h2>
    </div>
    <div class="content">
        <p><strong>Nama:</strong> {{ $riwayat->user->nama }}</p>
        <p><strong>NIM:</strong> {{ $riwayat->user->nim }}</p>
        <p><strong>No.Hp:</strong> {{ $riwayat->mahasiswa->phone }}</p>
        <p><strong>Email:</strong> {{ $riwayat->user->email }}</p>
        <p><strong>Nama Kamar:</strong> {{ optional($riwayat->room)->nama_kamar ?? '-' }}</p>
        <p><strong>Bulan:</strong> {{ ucfirst($riwayat->bulan) }}</p>
        <p><strong>Tahun:</strong> {{ $riwayat->tahun }}</p>
        <p><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($riwayat->tanggal_pembayaran)->format('d-m-Y') }}
        </p>
        <p><strong>Jumlah Bayar:</strong> Rp{{ number_format($riwayat->harga, 0, ',', '.') }}</p>
    </div>
</body>

</html>
