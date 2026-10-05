<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quote of the Day</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg-dark: #120d09;
            --bg-card: #18120d;
            --bg-card-hover: #221a13;
            --accent-gold: #f5a623;
            --accent-gold-hover: #e59516;
            --accent-orange: #c85a28;
            --text-main: #fbf8f3;
            --text-muted: #9e8e7e;
            --border-warm: rgba(245, 166, 35, 0.18);
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .font-mono-tech {
            font-family: 'JetBrains Mono', monospace;
        }

        .font-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Subtle atelier grid background */
        .grid-pattern {
            background-image:
                linear-gradient(to right, rgba(245, 166, 35, 0.035) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(245, 166, 35, 0.035) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .ambient-glow {
            position: absolute;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.08) 0%, rgba(200, 90, 40, 0.03) 50%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
        }

        .quote-mark {
            color: rgba(245, 166, 35, 0.15);
            line-height: 0;
        }

        /* Custom scrollbar just in case */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(245, 166, 35, 0.2);
        }
    </style>
</head>
<body class="h-full flex items-center justify-center relative select-none antialiased grid-pattern">

    <!-- Ambient Lighting Backdrop -->
    <div class="ambient-glow"></div>

    <!-- Technical Corner Crosshairs -->
    <div class="absolute top-8 left-8 text-[#f5a623]/30 font-mono-tech text-xs tracking-widest pointer-events-none hidden md:block">
        + ATELIER.EDITION // 2026
    </div>
    <div class="absolute top-8 right-8 text-[#f5a623]/30 font-mono-tech text-xs tracking-widest pointer-events-none hidden md:block">
        DAILY_QUOTE.SYS // ID-{{ $quote['id'] ?? '01' }}
    </div>
    <div class="absolute bottom-8 left-8 text-[#9e8e7e]/40 font-mono-tech text-xs tracking-wider pointer-events-none hidden md:block">
        EST. PRECISION PRINT LAB
    </div>
    <div class="absolute bottom-8 right-8 text-[#9e8e7e]/40 font-mono-tech text-xs tracking-wider pointer-events-none hidden md:block">
        FORMAT // 100% EXCELLENCE
    </div>

    <!-- Main Centered Stage (1 Full Viewport) -->
    <main class="relative z-10 w-full max-w-4xl mx-auto px-6 sm:px-10 py-6">

        <div class="flex flex-col items-center text-center">

            <!-- Category / Tag Pill -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-sm bg-[#1e1610] border border-[#f5a623]/30 mb-8 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-[#f5a623] animate-pulse"></span>
                <span class="text-[#f5a623] text-xs font-mono-tech font-semibold tracking-wider uppercase">
                    Quotes Hari Ini
                </span>
            </div>

            <!-- Quote Container Card -->
            <div class="relative w-full bg-[#18120d]/80 border border-[#f5a623]/20 backdrop-blur-md p-8 sm:p-12 md:p-14 shadow-2xl transition-all">

                <!-- Decorative Graphic Element Top Corner -->
                <div class="absolute -top-3 -right-3 w-8 h-8 border-t-2 border-r-2 border-[#f5a623]/60 pointer-events-none"></div>
                <div class="absolute -bottom-3 -left-3 w-8 h-8 border-b-2 border-l-2 border-[#f5a623]/60 pointer-events-none"></div>

                <!-- Big Quote Mark Background -->
                <div class="absolute top-4 left-6 text-7xl font-serif quote-mark select-none pointer-events-none">
                    “
                </div>

                <!-- Quote Text -->
                <blockquote class="relative z-10 text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-[#fbf8f3] leading-tight tracking-tight mb-8">
                    "{{ $quote['quote'] ?? 'Your heart is the size of an ocean. Go find yourself in its hidden depths.' }}"
                </blockquote>

                <!-- Author & Decorative Info -->
                <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-[#f5a623]/15">

                    <!-- Author Section -->
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-0.5 bg-[#f5a623]"></div>
                        <div class="text-left">
                            <span class="block text-xs font-mono-tech text-[#9e8e7e] uppercase tracking-wider">Author</span>
                            <h2 class="text-base sm:text-lg font-semibold text-[#f5a623] tracking-wide">
                                {{ $quote['author'] ?? 'Anonymous' }}
                            </h2>
                        </div>
                    </div>

                    <!-- Minor Badge / ID Tag -->
                    <div class="flex items-center gap-3">
                        <div class="bg-[#120d09] border border-[#f5a623]/20 px-3 py-1.5 text-xs font-mono-tech text-[#9e8e7e]">
                            REF <span class="text-[#fbf8f3] font-bold">#{{ $quote['id'] ?? '01' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Area -->
            <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                <!-- Reload / Refresh Button -->
                <button
                    onclick="window.location.reload()"
                    class="cursor-pointer inline-flex items-center gap-2.5 px-6 py-3 bg-[#f5a623] hover:bg-[#e59516] text-[#120d09] font-semibold text-sm tracking-wide transition-colors duration-150 shadow-md active:translate-y-0.5"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Kutipan Lainnya
                </button>

                <!-- Copy Quote Button -->
                <button
                    id="copyBtn"
                    onclick="copyQuote()"
                    class="cursor-pointer inline-flex items-center gap-2 px-6 py-3 bg-[#1e1610] hover:bg-[#281e15] border border-[#f5a623]/30 text-[#fbf8f3] font-medium text-sm tracking-wide transition-colors duration-150 active:translate-y-0.5"
                >
                    <svg id="copyIcon" class="w-4 h-4 text-[#f5a623]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span id="copyText">Salin Kutipan</span>
                </button>
            </div>

        </div>

    </main>

    <!-- Copy to Clipboard Script -->
    <script>
        function copyQuote() {
            const textToCopy = `"${ @json($quote['quote'] ?? '') }" - ${ @json($quote['author'] ?? '') }`;
            navigator.clipboard.writeText(textToCopy).then(() => {
                const copyText = document.getElementById('copyText');
                const copyBtn = document.getElementById('copyBtn');

                const originalText = copyText.innerText;
                copyText.innerText = 'Tersalin!';
                copyBtn.classList.add('border-[#f5a623]');

                setTimeout(() => {
                    copyText.innerText = originalText;
                    copyBtn.classList.remove('border-[#f5a623]');
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin:', err);
            });
        }
    </script>
</body>
</html>
