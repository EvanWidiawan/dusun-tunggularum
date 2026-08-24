<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jumlah_kunjungan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
