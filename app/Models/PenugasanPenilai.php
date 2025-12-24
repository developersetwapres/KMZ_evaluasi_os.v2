<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenugasanPenilai extends Model
{
    /** @use HasFactory<\Database\Factories\PenugasanPenilaiFactory> */
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'bobot_skor_id',
        'siklus_id',
        'outsourcing_id',
        'penilai_id',
        'tipe_penilai',
        'status',
        'catatan',
    ];


    protected $with = [
        'bobotSkor',
        'siklus',
        'outsourcings',
        'evaluators',

        'penilian',
    ];


    //------------------------ BelongsTo------------------------------
    public function bobotSkor(): BelongsTo
    {
        return $this->belongsTo(BobotSkor::class, 'bobot_skor_id');
    }

    public function siklus(): BelongsTo
    {
        return $this->belongsTo(Siklus::class, 'siklus_id');
    }

    public function outsourcings(): BelongsTo
    {
        return $this->belongsTo(Outsourcing::class, 'outsourcing_id');
    }

    public function evaluators(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }




    //------------------------ HasMany------------------------------
    public function penilian(): HasMany
    {
        return $this->hasMany(Penilaian::class, 'penugasan_id');
    }
}
