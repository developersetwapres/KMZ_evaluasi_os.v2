<?php

namespace App\Services\Penilaian;

use App\Models\Aspek;

class NilaiPeraspek
{
    public function getDetailByAspek($penilaian): array
    {
        $aspects = Aspek::with(['kriteria', 'bobotSkor'])->get();

        $finalTotalScore = 0;
        $aspectResults = [];

        foreach ($aspects as $aspect) {
            $kriteriaIds = $aspect->kriteria->pluck('id');

            // kumpulkan semua nilai kriteria dalam 1 aspek
            $nilai = collect();
            $bobot = optional($aspect->bobotSkor)->bobot;

            $penilaian
                ->whereIn('kriteria_id', $kriteriaIds)
                ->each(
                    fn($p) =>
                    $p->nilai !== null
                        ? $nilai->push((float) $p->nilai)
                        : null
                );

            if ($nilai->isEmpty() || $bobot === null) {
                continue;
            }

            $average = round($nilai->avg(), 2);
            $weighted = round($average * ($bobot / 100), 2);

            $finalTotalScore += $weighted;

            $aspectResults[] = [
                'title' => $aspect->title,
                'nilai' => $average,
                'avg' => round($nilai->avg(), 2),
                'bobot' => $bobot / 100,
            ];
        }

        return [
            'finalTotalScore' => round($finalTotalScore, 2),
            'aspects' => $aspectResults,
        ];
    }
}
