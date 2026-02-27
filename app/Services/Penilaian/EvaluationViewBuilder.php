<?php

namespace App\Services;

use App\Models\Penugasan;
use App\Models\PenugasanPenilai;
use App\Services\Penilaian\EvaluationEngine;

class EvaluationViewBuilder
{
    public function __construct(
        protected EvaluationEngine $engine
    ) {}

    public function build(PenugasanPenilai $penugasan): array
    {
        $result = $this->engine->calculate($penugasan);

        return [
            'finalScore' => $this->format($result['finalScore']),
            'finalGrade' => $result['finalGrade'],
            'status'     => $result['status'],

            'evaluators' => $this->mapEvaluators($result['evaluators']),
            'aspects'    => $this->mapAspects($result['aspects']),
        ];
    }

    private function mapEvaluators(array $evaluators): array
    {
        return collect($evaluators)->map(function ($evaluator) {
            return [
                'id'            => $evaluator['id'],
                'name'          => $evaluator['name'],
                'score'         => $this->format($evaluator['score'] ?? 0),
                'weightedScore' => $this->format($evaluator['weightedScore'] ?? 0),
                'weightPercent' => $evaluator['weightPercent'],
                'hasSubmitted'  => $evaluator['hasSubmitted'],
            ];
        })->values()->toArray();
    }

    private function mapAspects(array $aspects): array
    {
        return collect($aspects)->map(function ($aspect) {
            return [
                'id'            => $aspect['id'],
                'title'         => $aspect['title'],
                'average'       => $this->format($aspect['average']),
                'weightPercent' => $aspect['weightPercent'],
                'weightedScore' => $this->format($aspect['weightedScore']),
            ];
        })->values()->toArray();
    }

    private function format($number): float
    {
        return round((float) $number, 2);
    }
}
