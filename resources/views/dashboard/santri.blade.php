<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🧑‍🎓 Dashboard Santri — Selamat datang, {{ $user->name }}
            </h2>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                SANTRI
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ KARTU PROGRESS PERSONAL --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500">Surah Dihafal</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalSurahDihafal }}</p>
                    <p class="text-xs text-gray-400 mt-1">dari 114 surah</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Total Ayat Hafal</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalAyatDihafal }}</p>
                    <p class="text-xs text-gray-400 mt-1">dari target {{ $targetAyat }} ayat</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Persentase Target</p>
                    <p class="text-3xl font-bold text-yellow-600">
                        {{ $targetAyat > 0 ? round(($totalAyatDihafal / $targetAyat) * 100) : 0 }}%
                    </p>
                    <p class="text-xs text-gray-400 mt-1">Progress keseluruhan</p>
                </div>

            </div>

            {{-- ✅ PROGRESS BAR TARGET --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">
                    🎯 Progress Menuju Target
                </h3>
                @php
                    $persen = $targetAyat > 0
                        ? round(($totalAyatDihafal / $targetAyat) * 100)
                        : 0;
                @endphp
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm text-gray-600">{{ $totalAyatDihafal }} / {{ $targetAyat }} ayat</span>
                    <span class="text-sm font-semibold text-indigo-600">{{ $persen }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-indigo-500 h-4 rounded-full transition-all duration-500"
                         style="width: {{ $persen }}%"></div>
                </div>
            </div>

            {{-- ✅ CHART PROGRESS BULANAN (Line Chart) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    📈 Grafik Hafalan Bulanan
                </h3>
                <div class="relative" style="height: 300px;">
                    <canvas id="chartSantriProgress"></canvas>
                </div>
            </div>

            {{-- ✅ INFO SETORAN TERAKHIR (placeholder untuk Mhs 3) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    📝 Setoran Terakhir
                </h3>
                <div class="text-center py-8 text-gray-400">
                    <p class="text-4xl mb-2">📭</p>
                    <p class="text-sm">Belum ada riwayat setoran.</p>
                    <p class="text-xs mt-1">Riwayat setoran akan muncul di sini setelah kamu setor hafalan.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ✅ CHART.JS SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartSantriProgress').getContext('2d');

        const progressData = @json($progressBulanan);
        const labels       = progressData.map(p => p.bulan);
        const dataAyat     = progressData.map(p => p.ayat);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ayat Dihafal per Bulan',
                    data: dataAyat,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                    pointRadius: 5,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Riwayat Hafalan Bulanan Saya'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</x-app-layout>