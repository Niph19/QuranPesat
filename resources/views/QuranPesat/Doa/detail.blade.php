@extends('layouts.app')

@section('title', $doas['nama'] . ' - QuranPesat')

@section('content')
<style>
    .doa-detail-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 48px 0 40px;
        position: relative;
        overflow: hidden;
    }

    .doa-detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Ccircle cx='40' cy='40' r='30' fill='none' stroke='%231DAD97' stroke-opacity='0.06' stroke-width='1'/%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .back-link {
        align-self: flex-start;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #9CA3AF;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 24px;
        transition: color 0.2s;
        padding: 6px 0;
    }

    .back-link:hover { color: #1DAD97; }

    .category-badge {
        display: inline-block;
        padding: 4px 16px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        background: rgba(254, 243, 199, 0.15);
        color: #FCD34D;
        border: 1px solid rgba(252, 211, 77, 0.3);
        margin-bottom: 16px;
    }

    .doa-title {
        font-size: clamp(20px, 4vw, 32px);
        font-weight: 700;
        color: #F9FAFB;
        margin: 0;
        line-height: 1.2;
        padding: 0 8px;
    }

    /* Content Section */
    .content-section {
        background: var(--bg-secondary);
        min-height: 60vh;
        padding: 40px 0 80px;
    }

    .content-wrap {
        max-width: 780px;
        margin: 0 auto;
    }

    .content-card {
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 20px;
        overflow: hidden;
    }

    /* Arabic block */
    .arabic-block {
        padding: 40px 32px;
        background: linear-gradient(135deg, rgba(29,173,151,0.05), rgba(5,150,105,0.03));
        border-bottom: 1px solid var(--bg-tertiary);
    }

    .arabic-text {
        font-family: 'Amiri', serif;
        font-size: clamp(22px, 4vw, 36px);
        direction: rtl;
        text-align: right;
        line-height: 2.2;
        color: var(--text);
        margin: 0;
        word-break: break-word;
    }

    /* Section shared styles */
    .content-section-block {
        padding: 24px 32px;
        border-bottom: 1px solid var(--bg-tertiary);
    }

    .content-section-block:last-of-type {
        border-bottom: none;
    }

    .block-label {
        font-size: 11px;
        font-weight: 700;
        color: #1DAD97;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin: 0 0 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .block-label.label-tentang {
        color: #D97706;
    }

    /* Transliterasi */
    .latin-block {
        background: var(--bg-secondary);
    }

    .latin-text {
        font-size: 15px;
        color: var(--text-secondary);
        font-style: italic;
        line-height: 1.8;
        margin: 0;
    }

    /* Terjemahan */
    .translation-text {
        font-size: 15px;
        color: var(--text);
        line-height: 1.8;
        margin: 0;
        padding-left: 14px;
        border-left: 3px solid #1DAD97;
    }

    /* Tentang / Keterangan */
    .tentang-block {
        background: rgba(245, 158, 11, 0.03);
    }

    .tentang-text {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.75;
        margin: 0;
        white-space: pre-line;
    }

    /* Sumber tag */
    .source-tag {
        display: inline-block;
        margin-top: 10px;
        padding: 3px 10px;
        background: rgba(245, 158, 11, 0.1);
        border-radius: 9999px;
        font-size: 12px;
        color: #D97706;
        font-weight: 500;
    }

    /* Copy actions */
    .actions-bar {
        padding: 16px 32px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
        border-top: 1px solid var(--bg-tertiary);
    }

    .copy-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--bg-secondary);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 9999px;
        font-size: 13px;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s;
    }

    .copy-btn:hover {
        border-color: #1DAD97;
        color: #1DAD97;
    }

    /* Navigation */
    .doa-nav {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 20px;
    }

    .nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 12px;
        text-decoration: none;
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
        flex: 1;
        max-width: 48%;
    }

    .nav-btn:hover {
        border-color: #1DAD97;
        color: #1DAD97;
    }

    .nav-btn.nav-next {
        justify-content: flex-end;
    }

    .nav-spacer {
        flex: 1;
        max-width: 48%;
    }

    @media (max-width: 600px) {
        .arabic-block,
        .content-section-block,
        .actions-bar {
            padding-left: 20px;
            padding-right: 20px;
        }

        .arabic-block {
            padding-top: 28px;
            padding-bottom: 28px;
        }

        .doa-nav {
            flex-direction: column;
        }

        .nav-btn {
            max-width: 100%;
        }

        .nav-spacer { display: none; }
    }
</style>

<section class="doa-detail-hero">
    <div class="container hero-inner">
        <a href="{{ route('doa.index') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
            Kembali ke Daftar Doa
        </a>
        <span class="category-badge">{{ $doas['grup'] }}</span>
        <h1 class="doa-title">{{ $doas['nama'] }}</h1>
    </div>
</section>

<section class="content-section">
    <div class="container content-wrap">
        <div class="content-card">

            {{-- Teks Arab --}}
            @if(!empty($doas['ar']))
            <div class="arabic-block">
                <p class="arabic-text">{{ $doas['ar'] }}</p>
            </div>
            @endif

            {{-- Transliterasi Latin --}}
            @if(!empty($doas['tr']))
            <div class="content-section-block latin-block">
                <p class="block-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                    Latin
                </p>
                <p class="latin-text">{{ $doas['tr'] }}</p>
            </div>
            @endif

            {{-- Terjemah Indonesia --}}
            @if(!empty($doas['idn']))
            <div class="content-section-block">
                <p class="block-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Artinya
                </p>
                <p class="translation-text">{{ $doas['idn'] }}</p>
            </div>
            @endif

            {{-- Tentang / Keterangan --}}
            @if(!empty($doas['tentang']))
            <div class="content-section-block tentang-block">
                <p class="block-label label-tentang">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    Keterangan
                </p>
                <p class="tentang-text">{{ $doas['tentang'] }}</p>
            </div>
            @endif

            {{-- Copy Buttons --}}
            <div class="actions-bar">
                @if(!empty($doas['ar']))
                <button class="copy-btn" onclick="copyText(@json($doas['ar']), this)" aria-label="Salin teks Arab">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Salin Arab
                </button>
                @endif
                @if(!empty($doas['idn']))
                <button class="copy-btn" onclick="copyText(@json($doas['idn']), this)" aria-label="Salin terjemahan">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    Salin Terjemah
                </button>
                @endif
            </div>
        </div>

        {{-- Prev / Next Navigation --}}
        <nav class="doa-nav" aria-label="Navigasi doa">
            @if($doas['id'] > 1)
            <a href="{{ route('doa.show', $doas['id'] - 1) }}" class="nav-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                Doa Sebelumnya
            </a>
            @else
            <span class="nav-spacer"></span>
            @endif

            <a href="{{ route('doa.show', $doas['id'] + 1) }}" class="nav-btn nav-next">
                Doa Berikutnya
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </nav>
    </div>
</section>

<script>
    function copyText(text, btn) {
        navigator.clipboard.writeText(text).then(function () {
            const orig = btn.innerHTML;
            btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20,6 9,17 4,12"/></svg> Tersalin!`;
            btn.style.borderColor = '#1DAD97';
            btn.style.color = '#1DAD97';
            setTimeout(function () {
                btn.innerHTML = orig;
                btn.style.borderColor = '';
                btn.style.color = '';
            }, 2000);
        });
    }
</script>
@endsection
