<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaFactory> */
    use HasFactory;
    use HasUuid;

    //--------------- BelongsTo-----------------------
    public function aspek(): BelongsTo
    {
        return $this->belongsTo(Aspek::class, 'aspek_id');
    }



    //--------------- HasMany------------------------------
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function indikators(): HasMany
    {
        return $this->hasMany(Indikator::class, 'kriteria_id');
    }
}
