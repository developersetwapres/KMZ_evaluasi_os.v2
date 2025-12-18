<?php

// namespace App\Services\Penilaian;

// use Illuminate\Support\Collection;

// class RekapHasilService
// {
//     private const EVALUATORS = [
//         'atasan',
//         'penerima_layanan',
//         'teman_setingkat',
//     ];

//     public function hitung(Collection $penugasanPenilai): array
//     {
//         $evaluatorScores = [];
//         $nilaiTotalAkhir = 0;

//         foreach (self::EVALUATORS as $type) {
//             $penugasan = $penugasanPenilai
//                 ->firstWhere('tipe_penilai', $type);

//             $averageScore = 0;
//             $bobot = 0;

//             if ($penugasan) {
//                 $averageScore = $this->hitungNilaiPenilai($penugasan->penilian);
//                 $bobot = $penugasan->bobotSkor->bobot / 100;
//             }

//             $weightedScore = $averageScore * $bobot;
//             $nilaiTotalAkhir += $weightedScore;

//             $evaluatorScores[] = [
//                 'averageScore' => round($averageScore, 2),
//                 'bobot' => round($bobot, 2),
//                 'type' => $type,
//                 'weightedScore' => round($weightedScore, 2),
//             ];
//         }

//         return [
//             'finalTotalScore' => round($nilaiTotalAkhir, 2),
//             'evaluatorScores' => $evaluatorScores,
//         ];
//     }

//     protected function hitungNilaiPenilai(Collection $penilaians): float
//     {
//         if ($penilaians->isEmpty()) {
//             return 0;
//         }

//         $nilaiPerAspek = [];

//         foreach ($penilaians as $penilaian) {
//             $aspek = $penilaian->kriteria->aspek;

//             $nilaiPerAspek[$aspek->id]['bobot'] = $aspek->bobotSkor->bobot / 100;
//             $nilaiPerAspek[$aspek->id]['nilai'][] = $penilaian->nilai;
//         }

//         $total = 0;

//         foreach ($nilaiPerAspek as $data) {
//             $rata = array_sum($data['nilai']) / count($data['nilai']);
//             $total += $rata * $data['bobot'];
//         }

//         return $total;
//     }
// }




namespace App\Services\Penilaian;

use Illuminate\Support\Collection;

class RekapHasilService
{
    private const EVALUATORS = [
        'atasan',
        'penerima_layanan',
        'teman_setingkat',
    ];

    public function hitung(Collection $penugasanPenilai): array
    {
        $evaluatorScores = [];
        $nilaiTotalAkhir = 0;

        // 🔹 kumpulan nilai untuk aspek (lintas penilai)
        $aspekAccumulator = [];


        foreach (self::EVALUATORS as $type) {
            $penugasan = $penugasanPenilai
                ->firstWhere('tipe_penilai', $type);

            $averageScore = 0;
            $bobot = 0;

            if ($penugasan) {
                // hitung nilai per penilai
                $averageScore = $this->hitungNilaiPenilai(
                    $penugasan->penilian,
                    $aspekAccumulator // <-- dikumpulkan juga
                );

                $bobot = $penugasan->bobotSkor->bobot / 100;
            }

            $weightedScore = $averageScore * $bobot;
            $nilaiTotalAkhir += $weightedScore;

            $evaluatorScores[] = [
                'type' => $type,
                'evaluatorName' => $penugasan?->evaluators?->userable?->name,
                'averageScore' => round($averageScore, 2),
                'bobot' => round($bobot, 2),
                'weightedScore' => round($weightedScore, 2),
            ];
        }

        // 🔹 hitung skor aspek
        $aspekScores = $this->hitungAspekScores($aspekAccumulator);

        return [
            'finalTotalScore' => round($nilaiTotalAkhir, 2),
            'evaluatorScores' => $evaluatorScores,
            'aspekScores' => $aspekScores,
        ];
    }

    /**
     * Hitung nilai 1 penilai + kumpulkan nilai aspek global
     */
    protected function hitungNilaiPenilai(
        Collection $penilaians,
        array &$aspekAccumulator
    ): float {
        if ($penilaians->isEmpty()) {
            return 0;
        }

        $nilaiPerAspek = [];

        foreach ($penilaians as $penilaian) {
            $aspek = $penilaian->kriteria->aspek;

            // untuk penilai
            $nilaiPerAspek[$aspek->id]['bobot'] = $aspek->bobotSkor->bobot / 100;
            $nilaiPerAspek[$aspek->id]['nilai'][] = $penilaian->nilai;

            // untuk agregat aspek global
            $aspekAccumulator[$aspek->id]['aspek'] = $aspek->title;
            $aspekAccumulator[$aspek->id]['bobot'] = $aspek->bobotSkor->bobot / 100;
            $aspekAccumulator[$aspek->id]['nilai'][] = $penilaian->nilai;
        }

        $total = 0;

        foreach ($nilaiPerAspek as $data) {
            $rata = array_sum($data['nilai']) / count($data['nilai']);
            $total += $rata * $data['bobot'];
        }

        return $total;
    }

    /**
     * Hitung skor akhir per aspek (lintas penilai)
     */
    protected function hitungAspekScores(array $aspekAccumulator): array
    {
        $result = [];

        foreach ($aspekAccumulator as $data) {
            $rata = array_sum($data['nilai']) / count($data['nilai']);
            $weighted = $rata * $data['bobot'];

            $result[] = [
                'title' => $data['aspek'],
                'averageScore' => round($rata, 2),
                'bobot' => round($data['bobot'], 2),
                'weightedScore' => round($weighted, 2),
            ];
        }

        return $result;
    }
}
