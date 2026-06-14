<?php

namespace App\Http\Controllers;

use App\Models\Hafalan;
use Illuminate\Http\Request;

class HafalanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'surah'   => 'required',
            'ayat'    => 'required',
            'status'  => 'required',
        ]);

        Hafalan::create($request->all());

        return back()->with('success', 'Data hafalan berhasil disimpan!');
    }
}