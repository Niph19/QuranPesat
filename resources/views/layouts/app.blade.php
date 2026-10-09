<!DOCTYPE html>
<html lang="id" data-theme="system">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'QuranPesat - Islamic Digital Companion')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Sketch Design System Tokens */
            --primary: #1DAD97;
            --secondary: #F4EDE0;
            --success: #16A34A;
            --warning: #D97706;
            --danger: #DC2626;
            --surface: #FFFFFF;
            --text: #111827;
            --text-secondary: #6B7280;
            --text-muted: #9CA3AF;

            /* Islamic Color Enhancements */
            --emerald: #059669;
            --emerald-light: #A7F3D0;
            --gold: #F59E0B;
            --gold-light: #FEF3C7;
            --navy: #1E3A8A;
            --navy-light: #DBEAFE;

            /* Spacing Scale */
            --space-1: 4px;
            --space-2: 8px;
            --space-3: 12px;
            --space-4: 16px;
            --space-6: 24px;
            --space-8: 32px;

            /* Typography Scale */
            --text-xs: 12px;
            --text-sm: 14px;
            --text-base: 16px;
            --text-lg: 20px;
            --text-xl: 24px;
            --text-2xl: 32px;

            /* Border Radius */
            --radius-sm: 4px;
            --radius: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-pill: 9999px;

            /* Shadows - Tactile Sketch Style */
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.08);

            /* Background */
            --bg-primary: #FEFEFE;
            --bg-secondary: #F9FAFB;
            --bg-tertiary: #F3F4F6;

            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            :root:not([data-theme="light"]) {
                --surface: #1F2937;
                --text: #F9FAFB;
                --text-secondary: #D1D5DB;
                --text-muted: #9CA3AF;
                --bg-primary: #111827;
                --bg-secondary: #1F2937;
                --bg-tertiary: #374151;
                --secondary: #2D2316;
            }
        }

        :root[data-theme="dark"] {
            --surface: #1F2937;
            --text: #F9FAFB;
            --text-secondary: #D1D5DB;
            --text-muted: #9CA3AF;
            --bg-primary: #111827;
            --bg-secondary: #1F2937;
            --bg-tertiary: #374151;
            --secondary: #2D2316;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            font-size: var(--text-sm);
            line-height: 1.5;
            color: var(--text);
            background: var(--bg-primary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        [hidden] {
            display: none !important;
        }

        /* Arabic Font */
        .arabic {
            font-family: 'Amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 1.25em;
            line-height: 1.8;
        }

        /* Navbar */
        .navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--bg-tertiary);
            padding: var(--space-4) 0;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.95);
        }

        @media (prefers-color-scheme: dark) {
            :root:not([data-theme="light"]) .navbar {
                background: rgba(31, 41, 55, 0.95);
                border-bottom-color: var(--bg-tertiary);
            }
        }

        :root[data-theme="dark"] .navbar {
            background: rgba(31, 41, 55, 0.95);
            border-bottom-color: var(--bg-tertiary);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-4);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .navbar-brand::before {
            content: "☪";
            font-size: 1.5em;
        }

        .navbar-nav {
            display: flex;
            gap: var(--space-2);
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-link {
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-pill);
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .navbar-link:hover,
        .navbar-link.active {
            color: var(--primary);
            background: var(--secondary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-4);
        }

        /* Hero Section */
        .hero {
            padding: var(--space-8) 0;
            text-align: center;
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--secondary) 100%);
        }

        .hero-title {
            font-size: clamp(var(--text-xl), 4vw, var(--text-2xl));
            font-weight: 700;
            color: var(--text);
            margin: 0 0 var(--space-4);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: var(--text-base);
            color: var(--text-secondary);
            margin: 0 0 var(--space-6);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Search & Filter Controls */
        .controls {
            padding: var(--space-6) 0;
            background: var(--surface);
        }

        .search-container {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: var(--space-4);
            border: 2px solid var(--bg-tertiary);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            background: var(--bg-secondary);
            color: var(--text);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(29, 173, 151, 0.1);
        }

        .filter-select {
            padding: var(--space-3) var(--space-4);
            border: 2px solid var(--bg-tertiary);
            border-radius: var(--radius-pill);
            background: var(--bg-secondary);
            color: var(--text);
            font-size: var(--text-sm);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Stats Row */
        .stats {
            display: flex;
            justify-content: center;
            gap: var(--space-6);
            margin: var(--space-6) 0;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: var(--space-4);
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            min-width: 120px;
        }

        .stat-number {
            display: block;
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            font-size: var(--text-sm);
            color: var(--text-secondary);
            margin-top: var(--space-1);
        }

        /* Card Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--space-6);
            padding: var(--space-8) 0;
        }

        .card {
            background: var(--surface);
            border: 2px solid var(--bg-tertiary);
            border-radius: var(--radius-lg);
            padding: var(--space-6);
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--space-4);
        }

        .card-number {
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: var(--radius-pill);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: var(--text-sm);
            flex-shrink: 0;
        }

        .card-arabic {
            font-size: var(--text-lg);
            font-weight: 700;
        }

        .card-title {
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--text);
            margin: 0 0 var(--space-2);
        }

        .card-subtitle {
            font-size: var(--text-sm);
            color: var(--text-secondary);
            margin: 0 0 var(--space-4);
            font-style: italic;
        }

        .card-badges {
            display: flex;
            gap: var(--space-2);
            flex-wrap: wrap;
        }

        .badge {
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-pill);
            font-size: var(--text-xs);
            font-weight: 500;
            white-space: nowrap;
        }

        .badge-primary {
            background: var(--emerald-light);
            color: var(--emerald);
        }

        .badge-secondary {
            background: var(--gold-light);
            color: var(--gold);
        }

        .badge-info {
            background: var(--navy-light);
            color: var(--navy);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: var(--space-4);
            }

            .search-container {
                flex-direction: column;
            }

            .stats {
                gap: var(--space-4);
            }

            .card-grid {
                grid-template-columns: 1fr;
                gap: var(--space-4);
                padding: var(--space-6) 0;
            }

            .card-header {
                flex-direction: column;
                gap: var(--space-2);
                align-items: stretch;
            }

            .card-arabic {
                order: -1;
                text-align: right;
            }
        }

        /* Loading States */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: var(--space-8);
            color: var(--text-secondary);
        }

        /* Empty States */
        .empty-state {
            text-align: center;
            padding: var(--space-8);
            color: var(--text-secondary);
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: var(--space-4);
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('quran.index') }}" class="navbar-brand">QuranPesat</a>
            <ul class="navbar-nav">
                <li><a href="{{ route('quran.index') }}" class="navbar-link @if(request()->routeIs('quran.*')) active @endif">Al-Quran</a></li>
                <li><a href="{{ route('doa.index') }}" class="navbar-link @if(request()->routeIs('doa.*')) active @endif">Doa</a></li>
                <li><a href="{{ route('jadwal_salat.index') }}" class="navbar-link @if(request()->routeIs('jadwal_salat.*')) active @endif">Jadwal Salat</a></li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script>
        // Theme toggle functionality
        function initTheme() {
            const theme = localStorage.getItem('theme') || 'system';
            document.documentElement.setAttribute('data-theme', theme);
        }

        // Search functionality
        function initSearch() {
            const searchInput = document.getElementById('search');
            const filterSelect = document.getElementById('filter');
            const cards = document.querySelectorAll('.card[data-searchable]');

            function performSearch() {
                const query = searchInput?.value.toLowerCase() || '';
                const filter = filterSelect?.value || '';

                cards.forEach(card => {
                    const searchText = card.getAttribute('data-searchable').toLowerCase();
                    const categoryMatch = !filter || card.getAttribute('data-category') === filter;
                    const textMatch = !query || searchText.includes(query);

                    card.style.display = (categoryMatch && textMatch) ? 'block' : 'none';
                });

                updateEmptyState();
            }

            function updateEmptyState() {
                const visibleCards = Array.from(cards).filter(card => card.style.display !== 'none');
                const emptyState = document.getElementById('empty-state');

                if (emptyState) {
                    emptyState.style.display = visibleCards.length === 0 ? 'block' : 'none';
                }
            }

            searchInput?.addEventListener('input', performSearch);
            filterSelect?.addEventListener('change', performSearch);
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initTheme();
            initSearch();
        });
    </script>
</body>
</html>