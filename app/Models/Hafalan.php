<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    protected $fillable = ['user_id', 'surah', 'ayat', 'status'];

    // Menghubungkan ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}