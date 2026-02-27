<?php

namespace App\Services\Penilaian;

use Illuminate\Support\Collection;

class EvaluationEngine
{
    public function calculate(Collection $penugasanCollection): array
    {
        $evaluators = [];
        $globalAspek = [];
        $finalScore = 0;

        foreach ($penugasanCollection as $penugasan) {

            $evaluatorResult = $this->calculateEvaluator($penugasan);

            $evaluators[] = $evaluatorResult;

            $finalScore += $evaluatorResult['weightedScore'];

            // kumpulkan global aspek
            foreach ($evaluatorResult['aspects'] as $aspek) {
                $globalAspek[$aspek['id']]['title'] = $aspek['title'];
                $globalAspek[$aspek['id']]['nilai'][] = $aspek['averageScore'];
                $globalAspek[$aspek['id']]['bobot'] = $aspek['bobot'];
            }
        }

        return [
            'status' => $this->resolveStatus($evaluators),

            'finalScore' => round($finalScore, 2),
            'evaluators' => $evaluators,
            'aspectsGlobal' => $this->calculateGlobalAspek($globalAspek),
        ];
    }

    protected function calculateEvaluator($penugasan): array
    {
        $aspekData = [];
        $totalEvaluatorScore = 0;

        foreach ($penugasan->penilaian as $penilaian) {

            $aspek = $penilaian->kriteria->aspek;

            $aspekData[$aspek->id]['title'] = $aspek->title;
            $aspekData[$aspek->id]['bobot'] = $aspek->bobotSkor->bobot / 100;
            $aspekData[$aspek->id]['nilai'][] = $penilaian->nilai;
        }

        $aspekResults = [];

        foreach ($aspekData as $id => $data) {

            $avg = array_sum($data['nilai']) / count($data['nilai']);
            $weighted = $avg * $data['bobot'];

            $totalEvaluatorScore += $weighted;

            $aspekResults[] = [
                'id' => $id,
                'title' => $data['title'],
                'averageScore' => round($avg, 2),
                'weightedScore' => round($weighted, 2),
                'bobot' => $data['bobot'],
            ];
        }

        $bobotEvaluator = $penugasan->bobotSkor->bobot / 100;
        $weightedFinal = $totalEvaluatorScore * $bobotEvaluator;

        return [
            'type' => $penugasan->tipe_penilai,
            'uuidPenugasan' => $penugasan->uuid,
            'evaluatorName' => $penugasan->evaluators?->userable?->name,
            'averageScore' => round($totalEvaluatorScore, 2),
            'bobot' => $bobotEvaluator,
            'weightedScore' => round($weightedFinal, 2),
            'status' => $penugasan->status,
            'notes' => $penugasan->catatan,
            'aspects' => $aspekResults,
        ];
    }

    protected function calculateGlobalAspek(array $globalAspek): array
    {
        $result = [];

        foreach ($globalAspek as $id => $data) {

            $avg = array_sum($data['nilai']) / count($data['nilai']);
            $weighted = $avg * $data['bobot'];

            $result[] = [
                'id' => $id,
                'title' => $data['title'],
                'averageScore' => round($avg, 2),
                'weightedScore' => round($weighted, 2),
                'bobot' => $data['bobot'],
            ];
        }

        return $result;
    }

    private function resolveStatus(array $evaluators): string
    {
        $completed = collect($evaluators)
            ->every(fn($e) => $e['averageScore'] > 0);

        return $completed ? 'completed' : 'draft';
    }

    public function calculateDetailPerAspek(
        Collection $penugasanCollection,
        string $outsourcingUuid
    ): array {

        $result = $this->calculate($penugasanCollection);

        $aspects = [];

        foreach ($result['aspectsGlobal'] as $globalAspek) {

            $evaluators = [];

            foreach ($result['evaluators'] as $evaluator) {

                $found = false;

                foreach ($evaluator['aspects'] as $aspek) {

                    if ($aspek['id'] === $globalAspek['id']) {

                        $average = $aspek['averageScore'];
                        $weighted = $average * $evaluator['bobot'];

                        $evaluators[] = [
                            'evaluatorName' => $evaluator['evaluatorName'],
                            'evaluatorType' => $evaluator['type'],
                            'averageScore' => round($average, 2),
                            'weightedScore' => round($weighted, 2),
                            'bobot' => $evaluator['bobot'],
                        ];

                        $found = true;
                        break;
                    }
                }

                // kalau evaluator belum menilai
                if (!$found) {

                    $evaluators[] = [
                        'evaluatorName' => $evaluator['evaluatorName'],
                        'evaluatorType' => $evaluator['type'],
                        'averageScore' => 0,
                        'weightedScore' => 0,
                        'bobot' => $evaluator['bobot'],
                    ];
                }
            }

            $total = collect($evaluators)->sum('weightedScore');

            $aspects[] = [
                'id' => $globalAspek['id'],
                'aspectTitle' => $globalAspek['title'],
                'evaluators' => $evaluators,
                'total' => round($total, 2),
            ];
        }

        return [
            'uuid' => $outsourcingUuid,
            'aspects' => $aspects,
        ];
    }
}
