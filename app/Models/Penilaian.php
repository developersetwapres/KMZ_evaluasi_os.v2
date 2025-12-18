<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function penugasan(): BelongsTo
    {
        return $this->belongsTo(Outsourcing::class, 'penugasan_id');
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
