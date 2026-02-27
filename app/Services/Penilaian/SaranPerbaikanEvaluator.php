<?php

namespace App\Services\Penilaian;

use App\Models\Jabatan;
use App\Services\Penilaian\RekapHasilService;

class SaranPerbaikanEvaluator
{
    public function saranX()
    {
        $result = [];

        $jabatans = Jabatan::with([
            'outsourcings.penugasan' => function ($q) {
                $q->without(['outsourcings', 'penilaian',])
                    ->select('id', 'outsourcing_id', 'catatan', 'tipe_penilai', 'uuid', 'penilai_id');
                $q->with('evaluators.userable');
            },
        ])->get();


        foreach ($jabatans as $jabatan) {
            $saran = [];

            foreach ($jabatan->outsourcings->where('is_active', 1) as $os) {
                $saran[] = [
                    'nama' => $os->name,
                    'penugasan' => $os->penugasan,
                ];
            }

            if (! empty($saran)) {
                $result[] = [
                    'jabatan' => $jabatan->nama_jabatan,
                    'saran' => $saran,
                ];
            }
        }

        return $result;
    }

    public function saran()
    {
        $result = [];

        $jabatans = Jabatan::with([
            'outsourcings.penugasan.evaluators.userable',
        ])->get();

        foreach ($jabatans as $jabatan) {
            $saran = [];

            foreach ($jabatan->outsourcings->where('is_active', 1) as $os) {

                $penugasan = $os->penugasan->map(function ($p) {
                    return [
                        'nama' => $p->evaluators?->userable?->name,
                        'image' => $p->evaluators?->userable?->image,
                        'tipe_penilai' => $p->tipe_penilai,
                        'catatan' => $p->catatan,
                    ];
                });

                $saran[] = [
                    'name' => $os->name,
                    'image' => $os->image,
                    'penugasan' => $penugasan->values(),
                ];
            }

            if (!empty($saran)) {
                $result[] = [
                    'jabatan' => $jabatan->nama_jabatan,
                    'saran' => $saran,
                ];
            }
        }

        return $result;
    }
}
