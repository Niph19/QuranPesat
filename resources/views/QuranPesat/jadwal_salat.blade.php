@extends('layouts.app')

@section('title', 'Jadwal Salat - QuranPesat')

@section('content')
<style>
    .salat-hero {
        background: linear-gradient(135deg, #0a192f 0%, #172a45 50%, #0d3b4c 100%);
        padding: 48px 0 36px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .salat-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath fill='%231DAD97' fill-opacity='0.05' d='M30 5 L35 20 L50 20 L38 30 L43 45 L30 36 L17 45 L22 30 L10 20 L25 20 Z'/%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
    }

    .hero-arabic-calligraphy {
        font-family: 'Amiri', serif;
        font-size: clamp(26px, 5vw, 42px);
        color: #F59E0B;
        margin: 0 0 12px;
        text-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
    }

    .hero-title {
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 700;
        color: #F9FAFB;
        margin: 0 0 8px;
    }

    .hero-subtitle {
        font-size: 14px;
        color: #9CA3AF;
        margin: 0 auto;
        max-width: 520px;
    }

    /* Controls Panel */
    .controls-panel {
        background: var(--surface);
        padding: 20px 0;
        border-bottom: 1px solid var(--bg-tertiary);
        position: sticky;
        top: 61px;
        z-index: 40;
        backdrop-filter: blur(10px);
    }

    .controls-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .control-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .control-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .custom-select {
        padding: 10px 14px;
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 10px;
        font-size: 13.5px;
        background: var(--bg-secondary);
        color: var(--text);
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }

    .custom-select:focus {
        border-color: #1DAD97;
        box-shadow: 0 0 0 3px rgba(29, 173, 151, 0.12);
    }

    .custom-select:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Main Content */
    .main-salat-content {
        background: var(--bg-secondary);
        min-height: 60vh;
        padding: 28px 0 64px;
    }

    .content-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Card Today Salat */
    .today-card {
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .today-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--bg-tertiary);
    }

    .today-location-wrap {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .today-location {
        font-size: 18px;
        font-weight: 700;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .today-date {
        font-size: 13.5px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .next-prayer-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: rgba(29, 173, 151, 0.1);
        border: 1px solid rgba(29, 173, 151, 0.25);
        border-radius: 9999px;
        color: #059669;
        font-size: 12.5px;
        font-weight: 600;
    }

    .times-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 10px;
    }

    .time-card {
        background: var(--bg-secondary);
        border: 1px solid var(--bg-tertiary);
        border-radius: 12px;
        padding: 14px 6px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .time-card:hover {
        border-color: #1DAD97;
        transform: translateY(-2px);
    }

    .time-card.active {
        background: linear-gradient(135deg, rgba(29, 173, 151, 0.12), rgba(5, 150, 105, 0.18));
        border-color: #1DAD97;
        box-shadow: 0 4px 10px rgba(29, 173, 151, 0.15);
    }

    .time-label {
        font-size: 11px;
        color: var(--text-secondary);
        margin-bottom: 6px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.04em;
    }

    .time-value {
        font-size: 17px;
        font-weight: 700;
        color: var(--text);
        font-variant-numeric: tabular-nums;
    }

    .time-card.active .time-label {
        color: #059669;
    }

    .time-card.active .time-value {
        color: #1DAD97;
    }

    /* Monthly Table */
    .table-card {
        background: var(--surface);
        border: 1.5px solid var(--bg-tertiary);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--bg-tertiary);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin: 0;
    }

    .table-info-badge {
        font-size: 12px;
        color: var(--text-secondary);
        background: var(--bg-secondary);
        padding: 4px 10px;
        border-radius: 6px;
        border: 1px solid var(--bg-tertiary);
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .salat-table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
        font-size: 13px;
    }

    .salat-table th {
        background: var(--bg-secondary);
        color: var(--text-secondary);
        font-weight: 600;
        padding: 12px 10px;
        border-bottom: 1px solid var(--bg-tertiary);
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    .salat-table td {
        padding: 11px 10px;
        border-bottom: 1px solid var(--bg-tertiary);
        color: var(--text);
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
    }

    .salat-table tr:hover {
        background: var(--bg-secondary);
    }

    .salat-table tr.current-day {
        background: rgba(29, 173, 151, 0.08);
        font-weight: 600;
    }

    .salat-table tr.current-day td {
        color: #1DAD97;
    }

    /* Loading and Status Overlays */
    .state-overlay {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 56px 20px;
        gap: 12px;
        text-align: center;
    }

    .spinner {
        width: 36px;
        height: 36px;
        border: 3px solid var(--bg-tertiary);
        border-top-color: #1DAD97;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 900px) {
        .times-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .controls-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 560px) {
        .times-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .controls-grid {
            grid-template-columns: 1fr;
        }
        .controls-panel {
            position: static;
        }
    }
</style>

<section class="salat-hero">
    <div class="container hero-inner">
        <div class="hero-arabic-calligraphy">أَقِمِ الصَّلَاةَ لِدُلُوكِ الشَّمْسِ</div>
        <h1 class="hero-title">Jadwal Salat & Imsakiyah</h1>
        <p class="hero-subtitle">Jadwal salat akurat berdasarkan lokasi provinsi, kota, dan kabupaten di seluruh Indonesia</p>
    </div>
</section>

<section class="controls-panel">
    <div class="container">
        <div class="controls-grid">
            <div class="control-group">
                <label class="control-label" for="select-provinsi">Provinsi</label>
                <select id="select-provinsi" class="custom-select">
                    @foreach($provinsiData as $prov)
                        @php
                            $pNama = is_array($prov) ? ($prov['nama'] ?? $prov['name'] ?? $prov['provinsi'] ?? '') : $prov;
                        @endphp
                        <option value="{{ $pNama }}" {{ strtoupper($pNama) === 'DKI JAKARTA' || strtoupper($pNama) === 'JAWA BARAT' ? 'selected' : '' }}>
                            {{ $pNama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="control-group">
                <label class="control-label" for="select-kabkota">Kota / Kabupaten</label>
                <select id="select-kabkota" class="custom-select" disabled>
                    <option value="">Memuat data...</option>
                </select>
            </div>

            <div class="control-group">
                <label class="control-label" for="select-bulan">Bulan</label>
                <select id="select-bulan" class="custom-select">
                    @php
                        $months = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                            4 => 'April', 5 => 'Mei', 6 => 'Juni',
                            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                        $currMonth = (int) date('n');
                    @endphp
                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ $num === $currMonth ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="control-group">
                <label class="control-label" for="select-tahun">Tahun</label>
                <select id="select-tahun" class="custom-select">
                    @php $currYear = (int) date('Y'); @endphp
                    @for($y = $currYear - 1; $y <= $currYear + 1; $y++)
                        <option value="{{ $y }}" {{ $y === $currYear ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
</section>

<section class="main-salat-content">
    <div class="container content-container">
        <!-- Today Highlights Card -->
        <div class="today-card" id="today-container">
            <div class="today-header">
                <div class="today-location-wrap">
                    <div class="today-location">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1DAD97" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span id="lokasi-text">Memuat Lokasi...</span>
                    </div>
                    <div class="today-date" id="tanggal-text">--</div>
                </div>
                <div class="next-prayer-badge" id="prayer-status-badge">
                    <span>Memperbarui jadwal...</span>
                </div>
            </div>

            <div class="times-grid" id="times-wrapper">
                <div class="time-card" id="card-imsak"><div class="time-label">Imsak</div><div class="time-value" id="val-imsak">--:--</div></div>
                <div class="time-card" id="card-subuh"><div class="time-label">Subuh</div><div class="time-value" id="val-subuh">--:--</div></div>
                <div class="time-card" id="card-terbit"><div class="time-label">Terbit</div><div class="time-value" id="val-terbit">--:--</div></div>
                <div class="time-card" id="card-dhuha"><div class="time-label">Dhuha</div><div class="time-value" id="val-dhuha">--:--</div></div>
                <div class="time-card" id="card-dzuhur"><div class="time-label">Dzuhur</div><div class="time-value" id="val-dzuhur">--:--</div></div>
                <div class="time-card" id="card-ashar"><div class="time-label">Ashar</div><div class="time-value" id="val-ashar">--:--</div></div>
                <div class="time-card" id="card-maghrib"><div class="time-label">Maghrib</div><div class="time-value" id="val-maghrib">--:--</div></div>
                <div class="time-card" id="card-isya"><div class="time-label">Isya</div><div class="time-value" id="val-isya">--:--</div></div>
            </div>
        </div>

        <!-- Monthly Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title" id="table-title">Jadwal Sebulan Penuh</h3>
                <span class="table-info-badge" id="table-subtitle">Memuat data...</span>
            </div>
            <div class="table-responsive">
                <table class="salat-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Imsak</th>
                            <th>Subuh</th>
                            <th>Terbit</th>
                            <th>Dhuha</th>
                            <th>Dzuhur</th>
                            <th>Ashar</th>
                            <th>Maghrib</th>
                            <th>Isya</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Rows injected via JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="state-overlay" id="loading-state" style="display: none;">
                <div class="spinner"></div>
                <span style="font-size: 13px; color: var(--text-secondary);">Memuat jadwal salat...</span>
            </div>
            <div class="state-overlay" id="empty-state" style="display: none;">
                <p style="color: var(--text-secondary); margin: 0;">Data jadwal salat tidak tersedia untuk pilihan ini.</p>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
        const selectProvinsi = document.getElementById('select-provinsi');
        const selectKabkota = document.getElementById('select-kabkota');
        const selectBulan = document.getElementById('select-bulan');
        const selectTahun = document.getElementById('select-tahun');

        const lokasiText = document.getElementById('lokasi-text');
        const tanggalText = document.getElementById('tanggal-text');
        const prayerBadge = document.getElementById('prayer-status-badge');
        const tableTitle = document.getElementById('table-title');
        const tableSubtitle = document.getElementById('table-subtitle');

        const valImsak = document.getElementById('val-imsak');
        const valSubuh = document.getElementById('val-subuh');
        const valTerbit = document.getElementById('val-terbit');
        const valDhuha = document.getElementById('val-dhuha');
        const valDzuhur = document.getElementById('val-dzuhur');
        const valAshar = document.getElementById('val-ashar');
        const valMaghrib = document.getElementById('val-maghrib');
        const valIsya = document.getElementById('val-isya');

        const tableBody = document.getElementById('table-body');
        const loadingState = document.getElementById('loading-state');
        const emptyState = document.getElementById('empty-state');

        // Fetch Kabupaten / Kota based on chosen Provinsi
        async function fetchKabupaten() {
            const provinsi = selectProvinsi.value;
            if (!provinsi) return;

            selectKabkota.disabled = true;
            selectKabkota.innerHTML = '<option value="">Memuat kota/kabupaten...</option>';

            try {
                const res = await fetch(`/api/jadwal-salat/kabkota?provinsi=${encodeURIComponent(provinsi)}`);
                const result = await res.json();
                const list = result.data || [];

                selectKabkota.innerHTML = '';
                if (list.length === 0) {
                    selectKabkota.innerHTML = '<option value="">Tidak ada data kota</option>';
                    return;
                }

                list.forEach(item => {
                    const nama = typeof item === 'object' ? (item.nama || item.kabkota || item.lokasi || '') : item;
                    const opt = document.createElement('option');
                    opt.value = nama;
                    opt.textContent = nama;
                    selectKabkota.appendChild(opt);
                });

                selectKabkota.disabled = false;
                fetchJadwalSalat();
            } catch (err) {
                console.error('Error fetching kabkota:', err);
                selectKabkota.innerHTML = '<option value="">Gagal memuat kota</option>';
            }
        }

        // Fetch Monthly Prayer Schedule via AJAX
        async function fetchJadwalSalat() {
            const provinsi = selectProvinsi.value;
            const kabkota = selectKabkota.value;
            const bulan = selectBulan.value;
            const tahun = selectTahun.value;

            if (!provinsi || !kabkota) return;

            loadingState.style.display = 'flex';
            emptyState.style.display = 'none';
            tableBody.innerHTML = '';
            lokasiText.textContent = `${kabkota}, ${provinsi}`;

            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const monthLabel = monthNames[parseInt(bulan) - 1] || bulan;
            tableTitle.textContent = `Jadwal Salat - ${kabkota}`;
            tableSubtitle.textContent = `${monthLabel} ${tahun}`;

            try {
                const res = await fetch(`/api/jadwal-salat?provinsi=${encodeURIComponent(provinsi)}&kabkota=${encodeURIComponent(kabkota)}&bulan=${bulan}&tahun=${tahun}`);
                const result = await res.json();

                loadingState.style.display = 'none';

                if (result.data && result.data.jadwal && result.data.jadwal.length > 0) {
                    renderJadwal(result.data);
                } else {
                    emptyState.style.display = 'flex';
                }
            } catch (err) {
                console.error('Error fetching jadwal salat:', err);
                loadingState.style.display = 'none';
                emptyState.style.display = 'flex';
            }
        }

        function renderJadwal(data) {
            const jadwalList = data.jadwal || [];
            if (jadwalList.length === 0) return;

            const now = new Date();
            const currentDayNum = now.getDate();
            const currentMonthNum = now.getMonth() + 1;
            const currentYearNum = now.getFullYear();

            const isCurrentMonthYear = (parseInt(selectBulan.value) === currentMonthNum) && (parseInt(selectTahun.value) === currentYearNum);

            // Find today's item or fallback to first item
            let todayItem = null;
            if (isCurrentMonthYear) {
                todayItem = jadwalList[currentDayNum - 1] || jadwalList[0];
            } else {
                todayItem = jadwalList[0];
            }

            // Fill Today highlights
            tanggalText.textContent = todayItem.tanggal || `Hari ke-${todayItem.hari || '1'}`;
            valImsak.textContent = todayItem.imsak || '--:--';
            valSubuh.textContent = todayItem.subuh || '--:--';
            valTerbit.textContent = todayItem.terbit || '--:--';
            valDhuha.textContent = todayItem.dhuha || '--:--';
            valDzuhur.textContent = todayItem.dzuhur || '--:--';
            valAshar.textContent = todayItem.ashar || '--:--';
            valMaghrib.textContent = todayItem.maghrib || '--:--';
            valIsya.textContent = todayItem.isya || '--:--';

            highlightActivePrayer(todayItem);

            // Render Table Rows
            let html = '';
            jadwalList.forEach((row, idx) => {
                const dayIndex = idx + 1;
                const isTodayRow = isCurrentMonthYear && (dayIndex === currentDayNum);

                html += `
                    <tr class="${isTodayRow ? 'current-day' : ''}">
                        <td><strong>${row.tanggal || ('Hari ' + dayIndex)}</strong></td>
                        <td>${row.imsak || '-'}</td>
                        <td>${row.subuh || '-'}</td>
                        <td>${row.terbit || '-'}</td>
                        <td>${row.dhuha || '-'}</td>
                        <td>${row.dzuhur || '-'}</td>
                        <td>${row.ashar || '-'}</td>
                        <td>${row.maghrib || '-'}</td>
                        <td>${row.isya || '-'}</td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function highlightActivePrayer(todayItem) {
            // Reset active classes
            document.querySelectorAll('.time-card').forEach(el => el.classList.remove('active'));

            const now = new Date();
            const currentMinutes = now.getHours() * 60 + now.getMinutes();

            function timeToMinutes(tStr) {
                if (!tStr || !tStr.includes(':')) return -1;
                const [h, m] = tStr.split(':').map(Number);
                return h * 60 + m;
            }

            const prayers = [
                { id: 'card-imsak', name: 'Imsak', time: timeToMinutes(todayItem.imsak) },
                { id: 'card-subuh', name: 'Subuh', time: timeToMinutes(todayItem.subuh) },
                { id: 'card-terbit', name: 'Terbit', time: timeToMinutes(todayItem.terbit) },
                { id: 'card-dhuha', name: 'Dhuha', time: timeToMinutes(todayItem.dhuha) },
                { id: 'card-dzuhur', name: 'Dzuhur', time: timeToMinutes(todayItem.dzuhur) },
                { id: 'card-ashar', name: 'Ashar', time: timeToMinutes(todayItem.ashar) },
                { id: 'card-maghrib', name: 'Maghrib', time: timeToMinutes(todayItem.maghrib) },
                { id: 'card-isya', name: 'Isya', time: timeToMinutes(todayItem.isya) }
            ];

            // Find next prayer
            let nextPrayer = prayers.find(p => p.time > currentMinutes);
            if (!nextPrayer) {
                nextPrayer = prayers[0]; // Next day's Imsak
            }

            // Find current active prayer period
            let activePrayer = null;
            for (let i = prayers.length - 1; i >= 0; i--) {
                if (currentMinutes >= prayers[i].time && prayers[i].time > 0) {
                    activePrayer = prayers[i];
                    break;
                }
            }

            if (activePrayer) {
                const activeCard = document.getElementById(activePrayer.id);
                if (activeCard) activeCard.classList.add('active');
            }

            if (nextPrayer) {
                prayerBadge.innerHTML = `<span>Salat Berikutnya: <strong>${nextPrayer.name}</strong></span>`;
            }
        }

        // Event listeners for cascading updates
        selectProvinsi.addEventListener('change', fetchKabupaten);
        selectKabkota.addEventListener('change', fetchJadwalSalat);
        selectBulan.addEventListener('change', fetchJadwalSalat);
        selectTahun.addEventListener('change', fetchJadwalSalat);

        // Initial trigger
        fetchKabupaten();
    })();
</script>
@endsection
