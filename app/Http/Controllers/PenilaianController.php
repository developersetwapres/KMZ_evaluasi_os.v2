<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepenilaianRequest;
use App\Http\Requests\UpdatepenilaianRequest;
use App\Models\Aspek;
use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use App\Models\Penilaian;
use App\Models\PenugasanPenilai;
use App\Services\Penilaian\NilaiPeraspek;
use Illuminate\Http\RedirectResponse;
use App\Services\Penilaian\ViewScore;
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
            'rekapPerAspek' => $service->getDetailByAspek($penugasan->penilian),
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
    public function store(StorepenilaianRequest $request, PenugasanPenilai $penugasan)
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
}
