<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Outsourcing extends Model
{
    /** @use HasFactory<\Database\Factories\OutsourcingFactory> */
    use HasFactory;

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function penugasan(): HasMany
    {
        return $this->hasMany(PenugasanPenilai::class, 'outsourcing_id');
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
