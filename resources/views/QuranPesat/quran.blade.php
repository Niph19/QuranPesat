@extends('layouts.app')

@section('title', 'Al-Quran - QuranPesat')

@section('content')
<style>
    .quran-hero {
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #1a3a2a 100%);
        padding: 64px 0 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .quran-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath fill='%231DAD97' fill-opacity='0.06' d='M30 5 L35 20 L50 20 L38 30 L43 45 L30 36 L17 45 L22 30 L10 20 L25 20 Z'/%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }

    .quran-hero-inner {
        position: relative;
        z-index: 1;
    }

    .hero-bismillah {
        font-family: 'Amiri', serif;
        font-size: clamp(28px, 5vw, 48px);
        color: #F59E0B;
        margin: 0 0 24px;
        letter-spacing: 0.02em;
        text-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .hero-title {
        font-size: clamp(24px, 4vw, 40px);
        font-weight: 700;
        color: #F9FAFB;
        margin: 0 0 12px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 16px;
        color: #9CA3AF;
        margin: 0 auto 32px;
        max-width: 520px;
    }

    /* Search */
    .search-section {
        background: var(--surface);
        padding: 32px 0;
        border-bottom: 1px solid var(--bg-tertiary);
    }

    .search-wrap {
        max-width: 560px;
        margin: 0 auto;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        pointer-events: none;
    }

    .search-field {
        width: 100%;
        padding: 14px 16px 14px 44px;
        border: 2px solid var(--bg-tertiary);
        border-radius: 9999px;
        font-size: 16px;
        background: var(--bg-secondary);
        color: var(--text);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-field:focus {
        outline: none;
        border-color: #1DAD97;
        box-shadow: 0 0 0 4px rgba(29, 173, 151, 0.12);
    }

    /* Stats */
    .stats-row {
        display: flex;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 32px;
    }

    .stat-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(29,173,151,0.3);
        border-radius: 9999px;
        padding: 8px 20px;
        color: #E5E7EB;
        font-size: 14px;
    }

    .stat-pill strong {
        color: #1DAD97;
        font-size: 18px;
        font-weight: 700;
    }

    /* Main content */
    .main-content {
        background: var(--bg-secondary);
        min-height: 100vh;
        padding: 32px 0 64px;
    }

    .results-count {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    /* Surah Cards */
    .surah-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 16px;
    }

    .surah-card {
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 16px;
        padding: 20px;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .surah-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #1DAD97;
        transform: scaleY(0);
        transition: transform 0.25s ease;
        border-radius: 0 2px 2px 0;
    }

    .surah-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border-color: #1DAD97;
    }

    .surah-card:hover::before {
        transform: scaleY(1);
    }

    .surah-number-badge {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #1DAD97, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(29, 173, 151, 0.3);
    }

    .surah-info {
        flex: 1;
        min-width: 0;
    }

    .surah-latin {
        font-size: 16px;
        font-weight: 600;
        color: var(--text);
        margin: 0 0 2px;
    }

    .surah-translation {
        font-size: 13px;
        color: var(--text-secondary);
        margin: 0 0 8px;
        font-style: italic;
    }

    .surah-meta {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .meta-tag {
        padding: 2px 10px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 500;
    }

    .tag-mekah {
        background: #FEF3C7;
        color: #92400E;
    }

    .tag-madinah {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .tag-ayat {
        background: #ECFDF5;
        color: #065F46;
    }

    .surah-arabic-side {
        font-family: 'Amiri', serif;
        font-size: 22px;
        color: var(--text);
        flex-shrink: 0;
        text-align: right;
        direction: rtl;
        opacity: 0.85;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 64px 16px;
        display: none;
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.4;
    }

    .empty-text {
        font-size: 16px;
        color: var(--text-secondary);
        margin: 0;
    }

    @media (max-width: 640px) {
        .surah-grid {
            grid-template-columns: 1fr;
        }

        .surah-arabic-side {
            display: none;
        }
    }
</style>

<!-- Hero -->
<section class="quran-hero">
    <div class="container quran-hero-inner">
        <div class="hero-bismillah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
        <h1 class="hero-title">Jelajahi 114 Surat Al-Quran</h1>
        <p class="hero-subtitle">Baca, dengarkan, dan pahami ayat-ayat suci Al-Quran dengan mudah dan nyaman</p>

        <div class="stats-row">
            <div class="stat-pill"><strong>114</strong> Surat</div>
            <div class="stat-pill"><strong>6.236</strong> Ayat</div>
            <div class="stat-pill"><strong>30</strong> Juz</div>
            <div class="stat-pill"><strong>114</strong> Surah</div>
        </div>
    </div>
</section>

<!-- Search -->
<section class="search-section">
    <div class="container">
        <div class="search-wrap">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input
                type="search"
                id="search"
                class="search-field"
                placeholder="Cari surat... (nama, nomor, atau arti)"
                autocomplete="off"
                aria-label="Cari surat Al-Quran"
            >
        </div>
    </div>
</section>

<!-- Cards -->
<section class="main-content">
    <div class="container">
        <p class="results-count" id="results-count">
            Menampilkan <strong>{{ count($quran) }}</strong> surat
        </p>

        <div class="surah-grid" id="surah-grid">
            @foreach ($quran as $surat)
            <a
                href="{{ route('quran.show', $surat['nomor']) }}"
                class="surah-card"
                data-search="{{ strtolower($surat['namaLatin'] . ' ' . $surat['nomor'] . ' ' . $surat['arti']) }}"
            >
                <div class="surah-number-badge">{{ $surat['nomor'] }}</div>

                <div class="surah-info">
                    <p class="surah-latin">{{ $surat['namaLatin'] }}</p>
                    <p class="surah-translation">{{ $surat['arti'] }}</p>
                    <div class="surah-meta">
                        <span class="meta-tag {{ strtolower($surat['tempatTurun']) === 'mekah' ? 'tag-mekah' : 'tag-madinah' }}">
                            {{ $surat['tempatTurun'] }}
                        </span>
                        <span class="meta-tag tag-ayat">{{ $surat['jumlahAyat'] }} Ayat</span>
                    </div>
                </div>

                <div class="surah-arabic-side">{{ $surat['nama'] }}</div>
            </a>
            @endforeach
        </div>

        <div class="empty-state" id="empty-state">
            <div class="empty-icon">🔍</div>
            <p class="empty-text">Tidak ada surat yang cocok dengan pencarian Anda.</p>
        </div>
    </div>
</section>

<script>
    (function () {
        const searchInput = document.getElementById('search');
        const cards = document.querySelectorAll('.surah-card');
        const emptyState = document.getElementById('empty-state');
        const resultsCount = document.getElementById('results-count');

        function search() {
            const q = searchInput.value.toLowerCase().trim();
            let visible = 0;

            cards.forEach(card => {
                const text = card.getAttribute('data-search');
                const matches = !q || text.includes(q);
                card.hidden = !matches;
                if (matches) visible++;
            });

            emptyState.style.display = visible === 0 ? 'block' : 'none';
            resultsCount.innerHTML = q
                ? `Ditemukan <strong>${visible}</strong> surat untuk "<em>${searchInput.value}</em>"`
                : `Menampilkan <strong>${visible}</strong> surat`;
        }

        searchInput.addEventListener('input', search);
    })();
</script>
@endsection
    