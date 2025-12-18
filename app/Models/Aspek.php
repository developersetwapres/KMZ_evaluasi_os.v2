<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspek extends Model
{
    /** @use HasFactory<\Database\Factories\AspekFactory> */
    use HasFactory;

    //--------------- BelongsTo-----------------------
    public function bobotSkor(): BelongsTo
    {
        return $this->belongsTo(BobotSkor::class, 'bobot_skor_id');
    }



    //--------------- HasMany-----------------------
    public function kriteria(): HasMany
    {
        return $this->hasMany(Kriteria::class, 'aspek_id');
    }
}
