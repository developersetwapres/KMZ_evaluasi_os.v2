<?php

namespace App\Http\Controllers;

use App\Models\PenugasanPenilai;
use App\Http\Requests\StorePenugasanPenilaiRequest;
use App\Http\Requests\UpdatePenugasanPenilaiRequest;
use App\Models\Outsourcing;
use App\Models\Siklus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PenugasanPenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(): Response
    {
        $siklus = Siklus::where('aktif', 1)->first();

        if (!$siklus) {
            ['message' => 'Tidak ada siklus aktif'];
        }

        $outsourcings = Outsourcing::where('status', 'aktif')
            ->with([
                'penugasan' => fn($q) =>
                $q->where('siklus_id', $siklus->id)->with('evaluators.userable')
            ])
            ->get()
            ->map(function ($os) {

                $evaluators = [
                    'atasan' => ['name' => null, 'jabatan' => null],
                    'teman' => ['name' => null, 'jabatan' => null],
                    'penerima_layanan' => ['name' => null, 'jabatan' => null],
                ];

                foreach ($os->penugasan as $p) {
                    if (array_key_exists($p->tipe_penilai, $evaluators)) {
                        if ($evaluators[$p->tipe_penilai]['name'] === null) {
                            $evaluators[$p->tipe_penilai]['name'] = $p->evaluators?->userable?->name;
                            $evaluators[$p->tipe_penilai]['jabatan'] = $p->evaluators?->userable?->jabatan;
                        }
                    }
                }

                return [
                    'uuid'      => $os->uuid,
                    'name'    => $os->name,
                    'nama_jabatan'    => $os->jabatan->nama_jabatan,
                    'evaluators' => $evaluators,
                ];
            });

        $data = [
            'outsourcing' =>  $outsourcings,
        ];

        return Inertia::render('admin/penugasan/page', $data);
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
    public function store(StorePenugasanPenilaiRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = Str::uuid();

        $outsourcing = Outsourcing::create($data);

        return redirect()->back()->with('success', 'Data outsourcing berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenugasanPenilai $PenugasanPenilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenugasanPenilai $PenugasanPenilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenugasanPenilaiRequest $request, PenugasanPenilai $PenugasanPenilai)
    {

        $data = $request->validated();

        $PenugasanPenilai->update($data);

        return redirect()->back()->with('success', 'Data outsourcing berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenugasanPenilai $PenugasanPenilai)
    {
        $PenugasanPenilai->delete();
    }

    public function card(): Response
    {
        $data = [
            'penugasanPeer' => Auth::user()->penugasan()
                ->select(['outsourcing_id', 'siklus_id', 'status', 'uuid'])
                ->whereHas('siklus', function ($q) {
                    $q->where('is_active', true);
                })
                ->with(['siklus', 'outsourcings'])
                ->get(),
        ];

        return Inertia::render('evaluator/page', $data);
    }
}
