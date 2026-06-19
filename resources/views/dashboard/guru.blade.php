<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👨‍🏫 Dashboard Guru — Selamat datang, {{ $user->name }}
            </h2>
            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                GURU
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ KARTU STATISTIK RINGKAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Total Santri</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalSantri }}</p>
                    <p class="text-xs text-gray-400 mt-1">Santri terdaftar</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Setoran Hari Ini</p>
                    <p class="text-3xl font-bold text-green-600">0</p>
                    <p class="text-xs text-gray-400 mt-1">Menunggu penilaian</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6
                            border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500">Rata-rata Progress</p>
                    <p class="text-3xl font-bold text-purple-600">68%</p>
                    <p class="text-xs text-gray-400 mt-1">Dari semua santri</p>
                </div>

            </div>

            {{-- ✅ CHART PROGRESS SANTRI (Bar Chart pakai Chart.js) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    📊 Progress Hafalan Per Santri
                </h3>
                <div class="relative" style="height: 350px;">
                    <canvas id="chartGuruProgress"></canvas>
                </div>
            </div>

            {{-- ✅ TABEL RINGKAS PROGRESS SANTRI --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    📋 Ringkasan Progress Santri
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium
                                           text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium
                                           text-gray-500 uppercase tracking-wider">Surah Hafal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium
                                           text-gray-500 uppercase tracking-wider">Total Ayat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium
                                           text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($dataSantri as $santri)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                                           text-gray-900">{{ $santri['nama'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm
                                           text-gray-500">{{ $santri['total_surah'] }} surah</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm
                                           text-gray-500">{{ $santri['total_ayat'] }} ayat</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($santri['total_surah'] >= 15)
                                        <span class="px-2 inline-flex text-xs leading-5
                                                     font-semibold rounded-full bg-green-100
                                                     text-green-800">Sangat Baik</span>
                                    @elseif ($santri['total_surah'] >= 8)
                                        <span class="px-2 inline-flex text-xs leading-5
                                                     font-semibold rounded-full bg-yellow-100
                                                     text-yellow-800">Baik</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5
                                                     font-semibold rounded-full bg-red-100
                                                     text-red-800">Perlu Perhatian</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- ✅ CHART.JS SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartGuruProgress').getContext('2d');

        const dataSantri = @json($dataSantri);
        const labels     = dataSantri.map(s => s.nama);
        const dataAyat   = dataSantri.map(s => s.total_ayat);
        const dataSurah  = dataSantri.map(s => s.total_surah);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Ayat Dihafal',
                        data: dataAyat,
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    },
                    {
                        label: 'Jumlah Surah',
                        data: dataSurah,
                        backgroundColor: 'rgba(52, 211, 153, 0.7)',
                        borderColor: 'rgba(52, 211, 153, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Perbandingan Progress Hafalan Santri'
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