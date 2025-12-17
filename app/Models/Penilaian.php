<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    /** @use HasFactory<\Database\Factories\PenilaiansFactory> */
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'kriteria_id',
        'penugasan_id',
        'nilai',
    ];
}
