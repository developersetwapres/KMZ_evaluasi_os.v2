<?php

namespace App\Http\Controllers;

use App\Models\Outsourcing;
use App\Http\Requests\StoreOutsourcingRequest;
use App\Http\Requests\UpdateOutsourcingRequest;
use App\Models\Aspek;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Penilaian\EvaluationEngine;
use App\Services\Penilaian\NilaiPeraspek;
use Inertia\Inertia;
use Inertia\Response;

class OutsourcingController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOutsourcingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Outsourcing $Outsourcing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outsourcing $Outsourcing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutsourcingRequest $request, Outsourcing $Outsourcing)
    {
        $moveImageFromTemp = app(UploadController::class)->moveImageFromTemp(...);
        $finalImagePath = $moveImageFromTemp($request->image,  'os');

        $Outsourcing->update([
            'name' => $request->name,
            'jabatan_id' => $request->jabatan,
            'kode_biro' => $request->unit_kerja,
            'is_active' => $request->status,
            // 'nip' => $request->nip,
            'image' => $finalImagePath,
        ]);

        $idUser = $Outsourcing->load('user')->user->id;

        User::findOrFail($idUser)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data Outsourcing berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outsourcing $Outsourcing)
    {
        //
    }

    public function nilaiAkhir(
        Outsourcing $outsourcing,
        EvaluationEngine $engine
    ): Response {

        $outsourcing->load([
            'penugasan.bobotSkor',
            'penugasan.evaluators.userable',
            'penugasan.penilaian.kriteria.aspek.bobotSkor',
            'jabatan',
            'biro',
        ]);

        $penugasanCollection = $outsourcing->penugasan;

        $result = $engine->calculate($penugasanCollection);

        return Inertia::render('admin/detail/nilai-akhir', [
            'rekapAspekEvaluator' => [
                'id' => $outsourcing->id,
                'name' => $outsourcing->name,
                'uuid' => $outsourcing->uuid,
                'image' => $outsourcing->image,
                'jabatan' => $outsourcing->jabatan?->nama_jabatan,
                'unit_kerja' => $outsourcing->biro?->nama_biro,

                // kalau butuh satu uuid untuk reset
                // ambil dari evaluator saat klik saja (lebih clean)
                'status' => $result['status'],
                'finalTotalScore' => $result['finalScore'],
                'aspekScores' => $result['aspectsGlobal'],
                'evaluatorScores' => $result['evaluators'],
            ]
        ]);
    }

    public function rekapNilai(
        Outsourcing $outsourcing,
        EvaluationEngine $engine
    ): Response {

        $outsourcing->load([
            'penugasan.bobotSkor',
            'penugasan.evaluators.userable',
            'penugasan.penilaian.kriteria.aspek.bobotSkor',
        ]);

        $data = [
            'peraspek' => $engine->calculateDetailPerAspek(
                $outsourcing->penugasan,
                $outsourcing->uuid
            )
        ];

        return Inertia::render('admin/detail/rekap-nilai', $data);
    }

    public function catatanEvaluator(Outsourcing $outsourcing): Response
    {

        $data = [
            'penugasans' => $outsourcing->penugasan->load('evaluators.userable'),
            'uuidOs' => $outsourcing->uuid,
        ];

        return Inertia::render('admin/detail/catatan-evaluator', $data);
    }

    public function nilaiPerkriteria(Outsourcing $outsourcing, NilaiPeraspek $service, $tipePenilai = 'atasan'): Response
    {

        $penugasan = $outsourcing->penugasan->firstWhere('tipe_penilai', $tipePenilai);

        if (!$penugasan) {
            return Inertia::render('admin/detail/nilai-perkriteria', [
                'rekapPerAspek' => null,
                'evaluationData' => [],
                'uuidOs' => $outsourcing->uuid,
            ]);
        }

        $data = [
            'rekapPerAspek' => $service->getDetailByAspek($penugasan->penilaian),

            'evaluationData' => Aspek::select(['id', 'title'])
                ->with([
                    'kriteria' => fn($q) =>
                    $q->with([
                        'penilaian'
                        => fn($qPenilaian) =>
                        $qPenilaian->where('penugasan_id', $penugasan->id),

                        'indikators' => fn($q2) =>
                        $q2->where('jabatan_id', $outsourcing->jabatan_id)
                            ->orWhere('jabatan_id', 16),
                    ]),
                ])
                ->latest()
                ->get(),

            'uuidOs' => $outsourcing->uuid,
        ];

        return Inertia::render('admin/detail/nilai-perkriteria', $data);
    }
}
