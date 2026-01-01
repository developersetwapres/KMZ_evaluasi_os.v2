<?php

namespace App\Services\Penilaian;

use App\Models\Outsourcing;
use App\Models\Aspek;

class AspectEvaluationService
{
    public function getDetailByAspek(Outsourcing $outsourcing): array
    {
        $evaluatorTypes = ['atasan', 'penerima_layanan', 'teman_setingkat'];

        $aspects = Aspek::with('kriteria')->get();

        $penugasans = $outsourcing->penugasan()
            ->with([
                'penilian',
                'bobotSkor',
                'evaluators.userable.biro',
            ])
            ->get();

        $finalTotalScore = 0;
        $aspectsResult = [];

        foreach ($aspects as $aspect) {
            $kriteriaIds = $aspect->kriteria->pluck('id')->toArray();
            $evaluators = [];
            $totalByEvaluator = [];

            foreach ($evaluatorTypes as $type) {
                $nilai = collect();
                $evaluatorName = null;
                $biroName = null;
                $bobot = null;

                $penugasans->where('tipe_penilai', $type)->each(
                    function ($penugasan) use (
                        &$nilai,
                        &$evaluatorName,
                        &$biroName,
                        &$bobot,
                        $kriteriaIds
                    ) {
                        // ambil bobot dari penugasan
                        $bobot ??= optional($penugasan->bobotSkor)->bobot;

                        // evaluator info
                        if ($penugasan->evaluators) {
                            $userable = $penugasan->evaluators->userable;
                            $evaluatorName ??= $userable->name ?? $userable->nama ?? null;
                            $biroName ??= optional($userable->biro)->nama_biro;
                        }

                        // nilai per kriteria
                        $penugasan->penilian
                            ->whereIn('kriteria_id', $kriteriaIds)
                            ->each(
                                fn($p) => $p->nilai !== null
                                    ? $nilai->push((float) $p->nilai)
                                    : null
                            );
                    }
                );

                $averageScore = $nilai->count() ? round($nilai->avg(), 2) : null;

                // bobot diasumsikan DESIMAL (mis: 0.3, 0.4, 0.3)
                $weightedScore = ($averageScore !== null && $bobot !== null)
                    ? round($averageScore * ($bobot / 100), 2)
                    : null;

                $totalByEvaluator[] = $weightedScore ?? 0;

                $finalTotalScore += $weightedScore ?? 0;

                $evaluators[] = [
                    'evaluatorType' => $type,
                    'evaluatorName' => $evaluatorName,
                    'biro' => $biroName,
                    'averageScore' => $averageScore,
                    'bobot' => $bobot / 100,
                    'weightedScore' => $weightedScore,
                ];
            }

            $aspectsResult[] = [
                'aspectTitle' => $aspect->title,
                'totalByEvaluator' =>  $totalByEvaluator,
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
            'status' => $outsourcing->is_active,
            'finalTotalScore' => round($finalTotalScore, 4),
            'aspects' => $aspectsResult,
        ];
    }
}
