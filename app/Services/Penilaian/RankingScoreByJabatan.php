<?php

namespace App\Services\Penilaian;

use App\Models\Jabatan;
use App\Services\Penilaian\RekapHasilService;

class RankingScoreByJabatan
{
    public function ranking()
    {
        $result = [];

        $jabatans = Jabatan::with([
            'outsourcings.penugasan.bobotSkor',
            'outsourcings.penugasan.penilaian.kriteria.aspek.bobotSkor',
        ])->get();

        foreach ($jabatans as $jabatan) {
            $ranking = [];

            foreach ($jabatan->outsourcings->where('is_active', 1) as $os) {
                $rekap = app(RekapHasilService::class)
                    ->hitung($os->penugasan);

                $scores = collect($rekap['evaluatorScores'])
                    ->keyBy('type');

                $ranking[] = [
                    'nama' => $os->name,
                    'atasan' => $scores['atasan']['averageScore'] ?? 0,
                    'penerima_layanan' => $scores['penerima_layanan']['averageScore'] ?? 0,
                    'teman' => $scores['teman_setingkat']['averageScore'] ?? 0,
                    'total' => $rekap['finalTotalScore'],
                ];
            }

            // urutkan & beri ranking
            $ranking = collect($ranking)
                ->sortByDesc('total')
                ->values()
                ->map(function ($item, $index) {
                    $item['ranking'] = $index + 1;
                    return $item;
                })
                ->toArray();

            if (! empty($ranking)) {
                $result[] = [
                    'jabatan' => $jabatan->nama_jabatan,
                    'ranking' => $ranking,
                ];
            }
        }

        return $result;
    }
}
