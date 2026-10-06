<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat {{ $quran['namaLatin'] }}</title>
</head>

<body>
    <h1>{{ $quran['nama'] }}</h1>
    <audio src="{{ $quran['audioFull']['02'] }}" controls type="audio/mpeg"></audio>
    @foreach ($quran['ayat'] as $ayat)
        <p>{{ $ayat['nomorAyat'] }}</p>
        <p>{{ $ayat['teksArab'] }}</p>
        <p>{{ $ayat['teksLatin'] }}</p>
        <audio src="{{ $ayat['audio']['02'] }}" controls type="audio/mpeg"></audio>
    @endforeach
</body>

</html>