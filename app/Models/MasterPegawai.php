<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MasterPegawai extends Model
{
    /** @use HasFactory<\Database\Factories\MasterPegawaiFactory> */
    use HasFactory;

    public function biro(): BelongsTo
    {
        return $this->belongsTo(Biro::class, 'kode_biro', 'kode_biro');
    }



    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
