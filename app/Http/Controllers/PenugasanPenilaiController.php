<?php

namespace App\Http\Controllers;

use App\Models\PenugasanPenilai;
use App\Http\Requests\StorePenugasanPenilaiRequest;
use App\Http\Requests\UpdatePenugasanPenilaiRequest;
use App\Models\BobotSkor;
use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use App\Models\Siklus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class PenugasanPenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(): Response
    {
        $siklus = Siklus::where('is_active', 1)->first();

        if (!$siklus) {
            ['message' => 'Tidak ada siklus aktif'];
        }

        $outsourcings = Outsourcing::where('status', 'aktif')
            ->with([
                'penugasan' => fn($q) =>
                $q->where('siklus_id', $siklus->id)->with('evaluators.userable'),
                'biro',
                'jabatan'
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
                    'jabatan'      => $os->jabatan?->nama_jabatan,
                    'biro'      => $os->biro?->nama_biro,
                    'name'    => $os->name,
                    'nama_jabatan'    => $os->jabatan->nama_jabatan,
                    'evaluators' => $evaluators,
                ];
            });

        $data = [
            'outsourcing' =>  $outsourcings,
            'evaluators' => MasterPegawai::select(['name', 'jabatan', 'kode_biro', 'uuid'])
                ->where('kode_unit', '02')
                ->with('biro')
                ->orderBy('name', 'asc')
                ->get()
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
    public function store(Outsourcing $outsourcing, StorePenugasanPenilaiRequest $request)
    {
        DB::transaction(function () use ($outsourcing, $request) {

            $siklus = Siklus::where('is_active', 1)->firstOrFail();

            foreach ($request->validated() as $tipePenilai => $penilaiUuid) {

                // 1. Bobot skor
                $bobotSkor = BobotSkor::where('kode_bobot', $tipePenilai)
                    ->firstOrFail();

                // 2. Tentukan penilai berdasarkan tipe
                $penilaiUserId = match ($tipePenilai) {
                    'teman' => Outsourcing::where('uuid', $penilaiUuid)
                        ->with('user')
                        ->firstOrFail()
                        ->user
                        ->id,

                    'atasan', 'penerima_layanan' => MasterPegawai::where('uuid', $penilaiUuid)
                        ->with('user')
                        ->firstOrFail()
                        ->user
                        ->id,
                };

                // 3. Simpan penugasan
                PenugasanPenilai::updateOrCreate(
                    [
                        'siklus_id'      => $siklus->id,
                        'outsourcing_id' => $outsourcing->id,
                        'penilai_id'     => $penilaiUserId,
                        'tipe_penilai'   => $tipePenilai,
                    ],
                    [
                        'bobot_skor_id' => $bobotSkor->id,
                    ]
                );
            }
        });

        return back()->with('success', 'Penugasan penilai berhasil dibuat.');
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
        // dd(Hash::make('password'));
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
