<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .row { margin-bottom: 8px; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Bukti Pendaftaran Kamar</h2>
    <hr>
    <div class="row"><span class="label">Nama Lengkap</span>: {{ $data->nama }}</div>
    <div class="row"><span class="label">NIM</span>: {{ $data->nim }}</div>
    <div class="row"><span class="label">Email</span>: {{ $data->email }}</div>
    <div class="row"><span class="label">No HP</span>: {{ $data->no_hp }}</div>
    <div class="row"><span class="label">Prodi</span>: {{ $data->prodi }}</div>
    <div class="row"><span class="label">Jenis Kelamin</span>: {{ $data->jenis_kelamin }}</div>
    <div class="row"><span class="label">Tanggal Pendaftaran</span>: {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}</div>
    <div class="row"><span class="label">Nama Kamar</span>: {{ $data->room->nama_kamar ?? '-' }}</div>
    <div class="row"><span class="label">Status Berkas</span>: {{ ucfirst($data->status_berkas) }}</div>
    <hr>
    <p>Dokumen ini dihasilkan secara otomatis sebagai bukti pendaftaran.</p>
</body>
</html>
