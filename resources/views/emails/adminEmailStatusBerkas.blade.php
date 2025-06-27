<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Halo, {{ $data->nama }}</h2>

    <p>Status pendaftaran kamar asrama Anda telah <strong>{{ strtoupper($data->status_berkas) }}</strong>.</p>

    @if ($data->status_berkas === 'approved')
        <p>Selamat! Pendaftaran Anda telah diterima. Silakan tunggu info selanjutnya dari pihak pengelola asrama.</p>
    @elseif ($data->status_berkas === 'pending')
        <p>Pendaftaran Anda sedang dalam proses pengecekan. Mohon ditunggu ya.</p>
    @else
        <p>Mohon maaf, pendaftaran Anda tidak diterima. Silakan hubungi pihak admin untuk informasi lebih lanjut.</p>
    @endif

    <p>Terima kasih telah mendaftar.</p>
</body>

</html>
