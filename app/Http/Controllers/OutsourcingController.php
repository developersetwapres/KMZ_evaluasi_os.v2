<?php

namespace App\Http\Controllers;

use App\Models\Outsourcing;
use App\Http\Requests\StoreOutsourcingRequest;
use App\Http\Requests\UpdateOutsourcingRequest;
use App\Services\Penilaian\AspectEvaluationService;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outsourcing $Outsourcing)
    {
        //
    }

    public function rekaphasil(): Response
    {
        $Outsourcings = Outsourcing::with([
            'penugasan.bobotSkor',
            'penugasan.penilian.kriteria.aspek.bobotSkor',
        ])->where('status', 'aktif')->get();

        $evaluationResults = $Outsourcings->map(function ($os) {
            return [
                'id' => $os->id,
                'name' => $os->name,
                'uuid' => $os->uuid,
                'image' => $os->image,
                'jabatan' => $os->jabatan->nama_jabatan,
                ...app(RekapHasilService::class)->hitung($os->penugasan),
            ];
        });

        $data = [
            'evaluationResults' => $evaluationResults,
        ];

        return Inertia::render('admin/rekaphasil/page', $data);
    }


    public function detailByAspekEvaluator(Outsourcing $outsourcing): Response
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
                ...app(RekapHasilService::class)
                    ->hitung($outsourcing->penugasan->load('evaluators'))
            ]
        ];

        return Inertia::render('admin/detail/detailaspekevaluator', $data);
    }

    public function detailByAspek(Outsourcing $outsourcing, AspectEvaluationService $service): Response
    {

        $data = [
            'peraspek' =>  $service->getDetailByAspek($outsourcing)
        ];

        return Inertia::render('admin/detail/detailperaspek', $data);
    }
}
