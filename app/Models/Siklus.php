<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siklus extends Model
{
    /** @use HasFactory<\Database\Factories\SiklusFactory> */
    use HasFactory;

    public function bobotAspek()
    {
        return $this->hasMany(BobotAspek::class);
    }

    public function bobotPenilai()
    {
        return $this->hasMany(BobotPenilai::class);
    }
}
