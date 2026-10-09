@extends('layouts.app')

@section('title', 'Surat {{ $quran["namaLatin"] }} - QuranPesat')

@section('content')
<style>
    .detail-hero {
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #1a3a2a 100%);
        padding: 48px 0 40px;
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath fill='%231DAD97' fill-opacity='0.05' d='M30 5 L35 20 L50 20 L38 30 L43 45 L30 36 L17 45 L22 30 L10 20 L25 20 Z'/%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }

    .detail-hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .back-link {
        align-self: flex-start;
        display: flex;
        align-items: center;
        gap: 6px;
        color: #9CA3AF;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 24px;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #1DAD97;
    }

    .surah-arabic-name {
        font-family: 'Amiri', serif;
        font-size: clamp(36px, 8vw, 72px);
        color: #F59E0B;
        margin: 0 0 8px;
        text-shadow: 0 2px 12px rgba(245, 158, 11, 0.25);
    }

    .surah-latin-name {
        font-size: clamp(22px, 4vw, 36px);
        font-weight: 700;
        color: #F9FAFB;
        margin: 0 0 8px;
    }

    .surah-meaning {
        font-size: 16px;
        color: #9CA3AF;
        font-style: italic;
        margin: 0 0 20px;
    }

    .surah-meta-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 24px;
    }

    .meta-badge {
        padding: 4px 16px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 500;
    }

    .badge-mekah {
        background: rgba(254, 243, 199, 0.15);
        color: #FCD34D;
        border: 1px solid rgba(252, 211, 77, 0.3);
    }

    .badge-madinah {
        background: rgba(219, 234, 254, 0.15);
        color: #93C5FD;
        border: 1px solid rgba(147, 197, 253, 0.3);
    }

    .badge-ayat {
        background: rgba(167, 243, 208, 0.15);
        color: #6EE7B7;
        border: 1px solid rgba(110, 231, 183, 0.3);
    }

    /* Audio Player */
    .audio-section {
        background: var(--surface);
        border-bottom: 1px solid var(--bg-tertiary);
        padding: 24px 0;
    }

    .audio-player-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--bg-secondary);
        border-radius: 12px;
        padding: 16px 20px;
    }

    .audio-label {
        font-size: 14px;
        color: var(--text-secondary);
        white-space: nowrap;
    }

    .audio-native {
        flex: 1;
        height: 36px;
        accent-color: #1DAD97;
    }

    /* Bismillah Banner */
    .bismillah-banner {
        background: linear-gradient(135deg, #1DAD97, #059669);
        padding: 20px;
        text-align: center;
    }

    .bismillah-text {
        font-family: 'Amiri', serif;
        font-size: clamp(20px, 4vw, 32px);
        color: white;
        margin: 0;
        text-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }

    /* Ayat Section */
    .ayat-section {
        background: var(--bg-secondary);
        padding: 32px 0 64px;
    }

    .ayat-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .ayat-card {
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 16px;
        padding: 24px;
        transition: border-color 0.2s;
    }

    .ayat-card:hover {
        border-color: rgba(29, 173, 151, 0.4);
    }

    .ayat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .ayat-number {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #1DAD97, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .ayat-audio-btn {
        background: none;
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 9999px;
        padding: 6px 16px;
        font-size: 13px;
        color: #1DAD97;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .ayat-audio-btn:hover {
        background: #1DAD97;
        color: white;
        border-color: #1DAD97;
    }

    .ayat-arabic {
        font-family: 'Amiri', serif;
        font-size: clamp(20px, 3.5vw, 30px);
        direction: rtl;
        text-align: right;
        line-height: 2;
        color: var(--text);
        margin: 0 0 16px;
        padding: 16px;
        background: var(--bg-secondary);
        border-radius: 12px;
        border-right: 4px solid #1DAD97;
    }

    .ayat-latin {
        font-size: 14px;
        color: var(--text-secondary);
        font-style: italic;
        margin: 0 0 12px;
        line-height: 1.7;
        padding: 0 4px;
    }

    .ayat-translation {
        font-size: 14px;
        color: var(--text);
        line-height: 1.7;
        padding: 12px 16px;
        background: var(--bg-secondary);
        border-radius: 8px;
        border-left: 3px solid #F59E0B;
        margin: 0;
    }

    @media (max-width: 640px) {
        .audio-player-wrap {
            flex-direction: column;
            align-items: stretch;
        }

        .audio-native {
            width: 100%;
        }
    }
</style>

<!-- Detail Hero -->
<section class="detail-hero">
    <div class="container detail-hero-inner">
        <a href="{{ route('quran.index') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            Kembali ke Daftar Surat
        </a>

        <div class="surah-arabic-name">{{ $quran['nama'] }}</div>
        <h1 class="surah-latin-name">Surat {{ $quran['namaLatin'] }}</h1>
        <p class="surah-meaning">{{ $quran['arti'] }}</p>

        <div class="surah-meta-row">
            <span class="meta-badge {{ strtolower($quran['tempatTurun']) === 'mekah' ? 'badge-mekah' : 'badge-madinah' }}">
                {{ $quran['tempatTurun'] }}
            </span>
            <span class="meta-badge badge-ayat">{{ $quran['jumlahAyat'] }} Ayat</span>
            <span class="meta-badge badge-ayat">Surat ke-{{ $quran['nomor'] }}</span>
        </div>
    </div>
</section>

<!-- Audio Full Surat -->
@if(!empty($quran['audioFull']))
<section class="audio-section">
    <div class="container">
        <div class="audio-player-wrap">
            <span class="audio-label">Dengarkan lengkap:</span>
            <audio class="audio-native" controls>
                <source src="{{ $quran['audioFull']['02'] ?? $quran['audioFull'][array_key_first($quran['audioFull'])] }}" type="audio/mpeg">
            </audio>
        </div>
    </div>
</section>
@endif

<!-- Bismillah (except Al-Fatihah and At-Tawbah) -->
@if($quran['nomor'] != 9)
<div class="bismillah-banner">
    <p class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
</div>
@endif

<!-- Ayat List -->
<section class="ayat-section">
    <div class="container">
        <div class="ayat-list">
            @foreach ($quran['ayat'] as $ayat)
            <div class="ayat-card" id="ayat-{{ $ayat['nomorAyat'] }}">
                <div class="ayat-header">
                    <div class="ayat-number">{{ $ayat['nomorAyat'] }}</div>

                    @if(!empty($ayat['audio']))
                    <button
                        class="ayat-audio-btn"
                        onclick="playAyat(this, '{{ $ayat['audio']['02'] ?? $ayat['audio'][array_key_first($ayat['audio'])] }}')"
                        aria-label="Dengarkan ayat {{ $ayat['nomorAyat'] }}"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5,3 19,12 5,21"/>
                        </svg>
                        Dengarkan
                    </button>
                    @endif
                </div>

                <p class="ayat-arabic">{{ $ayat['teksArab'] }}</p>
                <p class="ayat-latin">{{ $ayat['teksLatin'] }}</p>
                <p class="ayat-translation">{{ $ayat['teksIndonesia'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    let currentAudio = null;

    function playAyat(btn, src) {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
        }

        const audio = new Audio(src);
        currentAudio = audio;

        audio.play();
        btn.innerHTML = `
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>
            </svg>
            Memutar...
        `;

        audio.addEventListener('ended', function () {
            btn.innerHTML = `
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5,3 19,12 5,21"/>
                </svg>
                Dengarkan
            `;
            currentAudio = null;
        });
    }
</script>
@endsection
