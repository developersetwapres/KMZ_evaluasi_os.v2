<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspek extends Model
{
    /** @use HasFactory<\Database\Factories\AspekFactory> */
    use HasFactory;

    public function kriteria(): HasMany
    {
        return $this->hasMany(Kriteria::class);
    }
}
