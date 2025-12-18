<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepenilaianRequest;
use App\Http\Requests\UpdatepenilaianRequest;
use App\Models\Aspek;
use App\Models\Penilaian;
use App\Models\PenugasanPenilai;
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
    public function create(PenugasanPenilai $penugasan): Response
    {

        $jabatanId = $penugasan->outsourcings->jabatan_id;

        $data = [
            'outsourcing' => $penugasan->outsourcings->load('jabatan'),
            'evaluator' => $penugasan->evaluators?->userable,
            'uuidPenugasanPeer' => $penugasan->uuid,
            'evaluationData' => Aspek::select(['id', 'title'])
                ->with([
                    'kriteria' => function ($q) use ($jabatanId) {
                        $q->with([
                            'penilaian',
                            'indikators' => function ($q2) use ($jabatanId) {
                                $q2->where('jabatan_id', $jabatanId)
                                    ->orWhere('jabatan_id', 16);
                            },
                        ]);
                    },
                ])
                ->get()

        ];

        if ($penugasan->status == 'completed') {
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
