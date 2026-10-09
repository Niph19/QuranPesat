@extends('layouts.app')

@section('title', 'Doa - QuranPesat')

@section('content')
<style>
    .doa-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 64px 0 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .doa-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Ccircle cx='40' cy='40' r='30' fill='none' stroke='%231DAD97' stroke-opacity='0.07' stroke-width='1'/%3E%3Ccircle cx='40' cy='40' r='20' fill='none' stroke='%231DAD97' stroke-opacity='0.05' stroke-width='1'/%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }

    .doa-hero-inner {
        position: relative;
        z-index: 1;
    }

    .hero-arabic-deco {
        font-family: 'Amiri', serif;
        font-size: clamp(28px, 5vw, 48px);
        color: #F59E0B;
        margin: 0 0 24px;
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

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 8px;
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

    /* Controls bar */
    .controls-section {
        background: var(--surface);
        padding: 32px 0;
        border-bottom: 1px solid var(--bg-tertiary);
    }

    .controls-inner {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-wrap {
        flex: 1;
        min-width: 220px;
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
        font-size: 15px;
        background: var(--bg-secondary);
        color: var(--text);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-field:focus {
        outline: none;
        border-color: #1DAD97;
        box-shadow: 0 0 0 4px rgba(29, 173, 151, 0.12);
    }

    .filter-wrap {
        flex-shrink: 0;
    }

    .filter-select {
        padding: 12px 36px 12px 16px;
        border: 2px solid var(--bg-tertiary);
        border-radius: 9999px;
        font-size: 14px;
        background: var(--bg-secondary);
        color: var(--text);
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        transition: border-color 0.2s;
    }

    .filter-select:focus {
        outline: none;
        border-color: #1DAD97;
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

    /* Doa Cards */
    .doa-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 16px;
    }

    .doa-card {
        display: block;
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 16px;
        padding: 24px;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .doa-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        background: radial-gradient(circle at top right, rgba(29,173,151,0.07), transparent 70%);
        pointer-events: none;
    }

    .doa-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border-color: #1DAD97;
    }

    .doa-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .doa-number {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #1DAD97, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 3px 6px rgba(29, 173, 151, 0.25);
    }

    .doa-category-badge {
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
        background: #FEF3C7;
        color: #92400E;
        letter-spacing: 0.01em;
    }

    .doa-name {
        font-size: 16px;
        font-weight: 600;
        color: var(--text);
        margin: 0 0 8px;
        line-height: 1.3;
    }

    .doa-arabic {
        font-family: 'Amiri', serif;
        font-size: 18px;
        direction: rtl;
        text-align: right;
        color: var(--text);
        margin: 12px 0;
        line-height: 2;
        padding: 12px;
        background: var(--bg-secondary);
        border-radius: 8px;
        border-right: 3px solid #1DAD97;
        /* Clamp to 2 lines */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .doa-translation {
        font-size: 13px;
        color: var(--text-secondary);
        margin: 0;
        font-style: italic;
        line-height: 1.5;
        /* Clamp to 2 lines */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .doa-card-footer {
        margin-top: 16px;
        display: flex;
        justify-content: flex-end;
    }

    .read-more {
        font-size: 13px;
        color: #1DAD97;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
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
        .doa-grid {
            grid-template-columns: 1fr;
        }

        .controls-inner {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-wrap {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }
    }
</style>

<!-- Hero -->
<section class="doa-hero">
    <div class="container doa-hero-inner">
        <div class="hero-arabic-deco">اَللّٰهُمَّ اغْفِرْ لِي</div>
        <h1 class="hero-title">Kumpulan Doa Sehari-hari</h1>
        <p class="hero-subtitle">Perkuat hubunganmu dengan Allah melalui doa yang dianjurkan dalam Islam</p>

        <div class="stats-row">
            <div class="stat-pill"><strong>{{ count($doas) }}</strong> Doa</div>
            <div class="stat-pill"><strong>{{ count(collect($doas)->pluck('grup')->unique()) }}</strong> Kategori</div>
        </div>
    </div>
</section>

<!-- Controls -->
<section class="controls-section">
    <div class="container">
        <div class="controls-inner">
            <div class="search-wrap">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="search"
                    id="search"
                    class="search-field"
                    placeholder="Cari doa..."
                    autocomplete="off"
                    aria-label="Cari doa"
                >
            </div>

            <div class="filter-wrap">
                <select id="filter" class="filter-select" aria-label="Filter kategori doa">
                    <option value="">Semua Kategori</option>
                    @foreach (collect($doas)->pluck('grup')->unique()->sort()->values() as $grup)
                        <option value="{{ $grup }}">{{ $grup }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Cards -->
<section class="main-content">
    <div class="container">
        <p class="results-count" id="results-count">
            Menampilkan <strong>{{ count($doas) }}</strong> doa
        </p>

        <div class="doa-grid" id="doa-grid">
            @foreach ($doas as $index => $doa)
            <a
                href="{{ route('doa.show', $doa['id']) }}"
                class="doa-card"
                data-search="{{ strtolower($doa['nama'] . ' ' . $doa['grup']) }}"
                data-category="{{ $doa['grup'] }}"
            >
                <div class="doa-card-header">
                    <div class="doa-number">{{ $index + 1 }}</div>
                    <span class="doa-category-badge">{{ $doa['grup'] }}</span>
                </div>

                <h3 class="doa-name">{{ $doa['nama'] }}</h3>

                @if(!empty($doa['ar']))
                <div class="doa-arabic">{{ $doa['ar'] }}</div>
                @endif

                @if(!empty($doa['idn']))
                <p class="doa-translation">{{ $doa['idn'] }}</p>
                @endif

                <div class="doa-card-footer">
                    <span class="read-more">
                        Baca selengkapnya
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="empty-state" id="empty-state">
            <div class="empty-icon">🤲</div>
            <p class="empty-text">Tidak ada doa yang cocok dengan pencarian Anda.</p>
        </div>
    </div>
</section>

<script>
    (function () {
        const searchInput = document.getElementById('search');
        const filterSelect = document.getElementById('filter');
        const cards = document.querySelectorAll('.doa-card');
        const emptyState = document.getElementById('empty-state');
        const resultsCount = document.getElementById('results-count');

        function update() {
            const q = searchInput.value.toLowerCase().trim();
            const cat = filterSelect.value;
            let visible = 0;

            cards.forEach(card => {
                const text = card.getAttribute('data-search');
                const cardCat = card.getAttribute('data-category');
                const matchesText = !q || text.includes(q);
                const matchesCat = !cat || cardCat === cat;
                const show = matchesText && matchesCat;
                card.hidden = !show;
                if (show) visible++;
            });

            emptyState.style.display = visible === 0 ? 'block' : 'none';

            let label = `Menampilkan <strong>${visible}</strong> doa`;
            if (q && filterSelect.value) {
                label += ` untuk "<em>${searchInput.value}</em>" dalam kategori <strong>${filterSelect.options[filterSelect.selectedIndex].text}</strong>`;
            } else if (q) {
                label += ` untuk "<em>${searchInput.value}</em>"`;
            } else if (cat) {
                label += ` dalam kategori <strong>${filterSelect.options[filterSelect.selectedIndex].text}</strong>`;
            }
            resultsCount.innerHTML = label;
        }

        searchInput.addEventListener('input', update);
        filterSelect.addEventListener('change', update);
    })();
</script>
@endsection
