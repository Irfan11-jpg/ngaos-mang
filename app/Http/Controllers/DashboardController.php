<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // Dashboard Guru
    public function guru(): View
    {
        $user = Auth::user();

        // ✅ Data dummy chart untuk Guru
        // (nanti Mhs 3 akan isi dari database setoran sungguhan)
        // Sekarang kita buat data dummy dulu supaya chart bisa tampil
        $dataSantri = [
            ['nama' => 'Ahmad',   'total_surah' => 12, 'total_ayat' => 230],
            ['nama' => 'Budi',    'total_surah' => 8,  'total_ayat' => 145],
            ['nama' => 'Citra',   'total_surah' => 15, 'total_ayat' => 310],
            ['nama' => 'Dewi',    'total_surah' => 5,  'total_ayat' => 89],
            ['nama' => 'Eko',     'total_surah' => 20, 'total_ayat' => 412],
        ];

        $totalSantri = User::where('role', 'santri')->count();

        return view('dashboard.guru', compact('user', 'dataSantri', 'totalSantri'));
    }

    // Dashboard Santri
    public function santri(): View
    {
        $user = Auth::user();

        // ✅ Data dummy chart untuk Santri
        // (nanti Mhs 3 akan isi dari database setoran sungguhan)
        $progressBulanan = [
            ['bulan' => 'Jan', 'ayat' => 45],
            ['bulan' => 'Feb', 'ayat' => 62],
            ['bulan' => 'Mar', 'ayat' => 38],
            ['bulan' => 'Apr', 'ayat' => 75],
            ['bulan' => 'Mei', 'ayat' => 90],
            ['bulan' => 'Jun', 'ayat' => 55],
        ];

        $totalSurahDihafal  = 10;   // dummy, nanti dari DB
        $totalAyatDihafal   = 230;  // dummy, nanti dari DB
        $targetAyat         = 300;  // dummy, nanti dari DB

        return view('dashboard.santri', compact(
            'user',
            'progressBulanan',
            'totalSurahDihafal',
            'totalAyatDihafal',
            'targetAyat'
        ));
    }
}