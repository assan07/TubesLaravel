<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Hai, {{ $user->nama }}!</h3>
    <p>Password akun Anda baru saja diubah pada {{ now()->format('d-m-Y H:i') }}.</p>
    <p>Jika Anda tidak melakukan perubahan ini, segera hubungi admin asrama.</p>
    <p>08123456789</p>
    <p>Terima kasih.</p>

</html>
