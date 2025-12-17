<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenugasanPenilai extends Model
{
    /** @use HasFactory<\Database\Factories\PenugasanPenilaiFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'siklus_id',
        'outsourcing_id',
        'penilai_id',
        'tipe_penilai',
        'bobot_penilai',
        'status',
        'catatan',
    ];


    public function siklus()
    {
        return $this->belongsTo(Siklus::class, 'siklus_id');
    }


    public function outsourcings()
    {
        return $this->belongsTo(Outsourcing::class, 'outsourcing_id');
    }

    public function evaluators(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }
}
