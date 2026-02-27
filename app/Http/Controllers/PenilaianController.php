<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenilaianRequest;
use App\Http\Requests\UpdatePenilaianRequest;
use App\Models\Aspek;
use App\Models\Outsourcing;
use App\Models\Penilaian;
use App\Models\PenugasanPenilai;
use App\Services\Penilaian\EvaluationEngine;
use App\Services\Penilaian\NilaiPeraspek;
use App\Services\Penilaian\RankingScoreByJabatan;
use App\Services\Penilaian\RekapHasilService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PenugasanPenilai $penugasan, NilaiPeraspek $service): Response | RedirectResponse
    {
        abort_if(!$penugasan->outsourcings, 404);

        if ($penugasan->evaluators->id !== Auth::id()) {
            return to_route('home');
        }

        $jabatanId = $penugasan->outsourcings->jabatan_id;

        $evaluator = $penugasan->evaluators?->userable;

        if ($penugasan->evaluators?->userable instanceof Outsourcing) {
            $evaluator->load('jabatan');
        }

        $data = [
            'outsourcing' => $penugasan->outsourcings->load(['jabatan', 'biro']),
            'evaluator' => $evaluator,
            'rekapPerAspek' => $service->getDetailByAspek($penugasan->penilaian),
            'uuidPenugasanPeer' => $penugasan->uuid,
            'tipePenilai' => $penugasan->tipe_penilai,
            'overallNotes' =>  $penugasan->catatan,
            'evaluationData' => Aspek::select(['id', 'title'])
                ->with([
                    'kriteria' => fn($q) =>
                    $q->with([
                        'penilaian' => fn($qPenilaian) =>
                        $qPenilaian->where('penugasan_id', $penugasan->id),

                        'indikators' => fn($q2) =>
                        $q2->where('jabatan_id', $jabatanId)
                            ->orWhere('jabatan_id', 16),
                    ]),
                ])
                ->latest()
                ->get(),
        ];

        if ($penugasan->status === 'completed') {
            return Inertia::render('evaluator/viewscore', $data);
        }

        return Inertia::render('evaluator/evaluation-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenilaianRequest $request, PenugasanPenilai $penugasan)
    // public function store(Request $request, PenugasanPenilai $penugasan)
    {
        foreach ($request->nilai as $key => $value) {
            Penilaian::create([
                'penugasan_id' => $penugasan->id,
                'kriteria_id' => $value['kriteria_id'],
                'nilai' => $value['skor'],
            ]);

            $penugasan->update([
                'catatan' => $request->catatan,
                'status' => 'completed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepenilaianRequest $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }

    public function rekaphasil(EvaluationEngine $engine): Response
    {
        $outsourcings = Outsourcing::with([
            'penugasan.bobotSkor',
            'penugasan.evaluators.userable',
            'penugasan.penilaian.kriteria.aspek.bobotSkor',
            'biro',
            'jabatan',
        ])
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();

        $evaluationResults = $outsourcings->map(function ($os) use ($engine) {

            $result = $engine->calculate($os->penugasan);

            return [
                'id' => $os->id,
                'name' => $os->name,
                'uuid' => $os->uuid,
                'image' => $os->image,
                'biro' => $os->biro?->nama_biro,
                'jabatan' => $os->jabatan?->nama_jabatan,

                'finalTotalScore' => $result['finalScore'],
                'evaluatorScores' => $result['evaluators'],
            ];
        });

        return Inertia::render('admin/rekaphasil/page', [
            'evaluationResults' => $evaluationResults,
        ]);
    }


    public function ranking(RankingScoreByJabatan $service): Response
    {
        $data = [
            'outsourcingData' => $service->ranking()
        ];

        return Inertia::render('admin/ranking/page', $data);
    }
}
