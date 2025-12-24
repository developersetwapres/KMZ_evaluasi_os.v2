<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kriteria extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaFactory> */
    use HasFactory;
    use HasUuid;

    protected $with = [
        'aspek',

        'penilaian',
        'indikators'
    ];

    //--------------- BelongsTo-----------------------
    public function aspek(): BelongsTo
    {
        return $this->belongsTo(Aspek::class, 'aspek_id');
    }



    //--------------- HasOne------------------------------
    public function penilaian(): HasOne
    {
        return $this->hasOne(Penilaian::class);
    }


    //--------------- HasMany------------------------------
    public function indikators(): HasMany
    {
        return $this->hasMany(Indikator::class, 'kriteria_id');
    }
}
