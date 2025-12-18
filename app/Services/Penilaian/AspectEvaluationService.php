<?php

namespace App\Services\Penilaian;

use App\Models\Outsourcing;
use App\Models\Aspek;

class AspectEvaluationService
{
    public function getDetailByAspek(Outsourcing $outsourcing): array
    {
        $evaluatorTypes = ['atasan', 'penerima_layanan', 'teman_setingkat'];

        $aspects = Aspek::with(['kriteria', 'bobotSkor'])->get();

        $penugasans = $outsourcing->penugasan()
            ->with([
                'penilian',
                'evaluators.userable.biro',
            ])
            ->get();
        $finalTotalScore = 0;
        $aspectsResult = [];

        foreach ($aspects as $aspect) {
            $kriteriaIds = $aspect->kriteria->pluck('id')->toArray();
            $aspectWeight = optional($aspect->bobotSkor)->bobot;

            $evaluators = [];

            foreach ($evaluatorTypes as $type) {
                $nilai = collect();
                $evaluatorName = null;
                $biroName = null;

                $penugasans->where('tipe_penilai', $type)->each(function ($penugasan) use (
                    &$nilai,
                    &$evaluatorName,
                    &$biroName,
                    $kriteriaIds
                ) {
                    // ambil nama evaluator & biro (cukup sekali)
                    if ($penugasan->evaluators) {
                        $userable = $penugasan->evaluators->userable;

                        $evaluatorName ??= $userable->name ?? $userable->nama ?? null;
                        $biroName ??= optional($userable->biro)->nama_biro;
                    }

                    $penugasan->penilian
                        ->whereIn('kriteria_id', $kriteriaIds)
                        ->each(
                            fn($p) => $p->nilai !== null
                                ? $nilai->push((float) $p->nilai)
                                : null
                        );
                });

                $averageScore = $nilai->count() ? $nilai->avg() : null;
                $weight = $aspectWeight ? (float) $aspectWeight : null;

                $weightedScore = ($averageScore !== null && $weight !== null)
                    ? $averageScore * ($weight / 100)
                    : null;

                $finalTotalScore += $weightedScore ?? 0;

                $evaluators[] = [
                    'evaluatorType' => $type,
                    'evaluatorName' => $evaluatorName,
                    'biro' => $biroName,
                    'averageScore' => $averageScore ? round($averageScore, 2) : null,
                    'bobot' => $weight ? round($weight, 2) : null,
                    'weightedScore' => $weightedScore ? round($weightedScore, 4) : null,
                ];
            }

            $aspectsResult[] = [
                'aspectTitle' => $aspect->title,
                'evaluators' => $evaluators,
            ];
        }

        return [
            'id' => $outsourcing->id,
            'uuid' => $outsourcing->uuid,
            'name' => $outsourcing->name,
            'biro' => optional($outsourcing->biro)->nama_biro,
            'jabatan' => optional($outsourcing->jabatan)->nama_jabatan,
            'image' => $outsourcing->image,
            'status' => $outsourcing->status,
            'finalTotalScore' => round($finalTotalScore, 4),
            'aspects' => $aspectsResult,
        ];
    }
}
