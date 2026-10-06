<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quran Pesat</title>
</head>
<body>
    <h1>Quran Pesat</h1>
    @foreach ($quran as $surat)
        <h2>{{ $surat['nomor'] }}</h2>
        <h1>{{ $surat['nama'] }}</h1>
        <h2>{{ $surat['namaLatin'] }}</h2>
        <a href="{{ route('quran.show', $surat['nomor']) }}">Lihat Surat</a>
    @endforeach
</body>
</html>