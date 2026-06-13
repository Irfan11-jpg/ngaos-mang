<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Jika dia guru, arahkan ke tampilan dashboard guru
        if ($user->role === 'guru') {
            return view('dashboard.guru');
        }

        // Jika dia santri, siapkan data grafik (dummy) lalu arahkan ke tampilan santri
        $chartData = [
            'labels' => ['Pekan 1', 'Pekan 2', 'Pekan 3', 'Pekan 4'],
            'data' => [10, 25, 45, 60] // Nanti data aslinya diurus Mhs 3
        ];

        return view('dashboard.santri', compact('chartData'));
    }
}