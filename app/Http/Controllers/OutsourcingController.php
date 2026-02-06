<?php

namespace App\Http\Controllers;

use App\Models\Outsourcing;
use App\Http\Requests\StoreOutsourcingRequest;
use App\Http\Requests\UpdateOutsourcingRequest;
use App\Models\Aspek;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Penilaian\AspectEvaluationService;
use App\Services\Penilaian\NilaiPeraspek;
use App\Services\Penilaian\RankingScoreByJabatan;
use App\Services\Penilaian\RekapHasilService;
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


    public function nilaiAkhir(Outsourcing $outsourcing): Response
    {
        $outsourcing->load([
            'penugasan.bobotSkor',
            'penugasan.penilian.kriteria.aspek.bobotSkor',
        ]);

        $data = [
            'rekapAspekEvaluator' => [
                'id' => $outsourcing->id,
                'name' => $outsourcing->name,
                'uuid' => $outsourcing->uuid,
                'image' => $outsourcing->image,
                'jabatan' => $outsourcing->jabatan->nama_jabatan,
                'unit_kerja' => $outsourcing->biro?->nama_biro,
                ...app(RekapHasilService::class)
                    ->hitung($outsourcing->penugasan->load('evaluators'))
            ]
        ];

        return Inertia::render('admin/detail/nilai-akhir', $data);
    }

    public function rekapNilai(Outsourcing $outsourcing, AspectEvaluationService $service): Response
    {

        $data = [
            'peraspek' =>  $service->getDetailByAspek($outsourcing)
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

        $data = [
            'rekapPerAspek' => $service->getDetailByAspek($penugasan->penilian),

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


    public function ranking(RankingScoreByJabatan $service): Response
    {
        $data = [
            'outsourcingData' => $service->ranking()
        ];

        return Inertia::render('admin/ranking/page', $data);
    }
}
