<?php

namespace App\Services\Penilaian;

use App\Models\Outsourcing;
use App\Models\Aspek;

class ViewScore
{
    public function getDetailByAspek(Outsourcing $outsourcing): array
    {
        $aspects = Aspek::with(['kriteria', 'bobotSkor'])->get();

        $penugasans = $outsourcing->penugasan()
            ->with(['penilian'])
            ->get();

        $finalTotalScore = 0;
        $aspectResults = [];

        foreach ($aspects as $aspect) {
            $kriteriaIds = $aspect->kriteria->pluck('id');

            // kumpulkan semua nilai kriteria dalam 1 aspek
            $nilai = collect();
            $bobot = null;

            $penugasans->each(function ($penugasan) use (&$nilai, &$bobot, $kriteriaIds, $aspect) {
                // ambil bobot pertama yang ada
                $bobot ??= optional($aspect->bobotSkor)->bobot;

                $penugasan->penilian
                    ->whereIn('kriteria_id', $kriteriaIds)
                    ->each(
                        fn($p) =>
                        $p->nilai !== null
                            ? $nilai->push((float) $p->nilai)
                            : null
                    );
            });

            if ($nilai->isEmpty() || $bobot === null) {
                continue;
            }

            $average = round($nilai->avg(), 2);
            $weighted = round($average * ($bobot / 100), 2);

            $finalTotalScore += $weighted;

            $aspectResults[] = [
                'title' => $aspect->title,
                'nilai' => $average,
                'bobot' => $bobot / 100,
            ];
        }

        return [
            'name' => $outsourcing->name,
            'finalTotalScore' => round($finalTotalScore, 2),
            'aspects' => $aspectResults,
        ];
    }
}
