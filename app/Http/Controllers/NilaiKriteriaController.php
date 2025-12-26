<?php

namespace App\Http\Controllers;

use App\Models\nilai_kriteria;
use App\Http\Requests\Storenilai_kriteriaRequest;
use App\Http\Requests\Updatenilai_kriteriaRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiKriteria;
use App\Models\Outsourcing;
use App\Services\Penilaian\RekapHasilService;
use Inertia\Inertia;
use Inertia\Response;

class NilaiKriteriaController extends Controller
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
    public function store(Storenilai_kriteriaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiKriteria $nilai_kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiKriteria $nilai_kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatenilai_kriteriaRequest $request, NilaiKriteria $nilai_kriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiKriteria $nilai_kriteria)
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
}
