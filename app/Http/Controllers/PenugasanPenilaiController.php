<?php

namespace App\Http\Controllers;

use App\Models\PenugasanPenilai;
use App\Http\Requests\StorePenugasanPenilaiRequest;
use App\Http\Requests\UpdatePenugasanPenilaiRequest;
use App\Models\BobotSkor;
use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use App\Models\Siklus;
use App\Services\Penilaian\RekapHasilService;
use App\Services\Penilaian\SaranPerbaikanEvaluator;
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
        // $siklus = Siklus::where('title', 'Semester I tahun 2026')->firstOrFail();


        if (!$siklus) {
            ['message' => 'Tidak ada siklus aktif'];
        }

        $outsourcings = Outsourcing::where('is_active', 1)
            ->with([
                'penugasan' => fn($q) =>
                $q->where('siklus_id', $siklus->id)->with('evaluators.userable'),
                'biro',
                'jabatan'
            ])
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($os) {

                $evaluators = [
                    'atasan' => ['name' => null, 'jabatan' => null, 'uuid' => null],
                    'teman_setingkat' => ['name' => null, 'jabatan' => null, 'uuid' => null],
                    'penerima_layanan' => ['name' => null, 'jabatan' => null, 'uuid' => null],
                ];

                foreach ($os->penugasan as $p) {
                    if (! array_key_exists($p->tipe_penilai, $evaluators)) {
                        continue;
                    }

                    if ($evaluators[$p->tipe_penilai]['name'] !== null) {
                        continue;
                    }

                    $userable = $p->evaluators?->userable;

                    if (! $userable) {
                        continue;
                    }

                    $evaluators[$p->tipe_penilai] = [
                        'name' => $userable->name,
                        'uuid' => $userable->uuid,
                        'jabatan' => method_exists($userable, 'displayJabatan')
                            ? $userable->displayJabatan()
                            : null,
                    ];
                }

                return [
                    'uuid' => $os->uuid,
                    'image' => $os->image,
                    'name' => $os->name,
                    'jabatan' => $os->jabatan?->nama_jabatan,
                    'biro' => $os->biro?->nama_biro,
                    'nama_jabatan' => $os->jabatan?->nama_jabatan,
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
                    'teman_setingkat' => Outsourcing::where('uuid', $penilaiUuid)
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
                        'tipe_penilai'   => $tipePenilai,
                    ],
                    [
                        'penilai_id'    => $penilaiUserId,
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

    public function home(): Response
    {
        // 1. Ambil semua penugasan milik user login (lengkap untuk hitung nilai)
        $penugasans = Auth::user()
            ->penugasan()
            ->with([
                'siklus',
                'outsourcings.jabatan',
                'penilian.kriteria.aspek.bobotSkor',
                'bobotSkor',
                'evaluators.userable',
            ])
            ->whereHas('siklus', fn($q) => $q->where('is_active', false))
            ->get();


        // 2. Group berdasarkan siklus
        $semesterHistory = $penugasans
            ->groupBy('siklus_id')
            ->map(function ($penugasanBySiklus) {
                $siklus = $penugasanBySiklus->first()->siklus;


                // 3. Di dalam siklus, group lagi berdasarkan outsourcing
                $employees = $penugasanBySiklus
                    ->groupBy('outsourcing_id')
                    ->map(function ($penugasanByOutsourcing) {
                        $first = $penugasanByOutsourcing->first();


                        // hitung score menggunakan service yang SUDAH ADA
                        $rekap = app(RekapHasilService::class)
                            ->hitung($penugasanByOutsourcing);


                        return [
                            'id' => $first->outsourcings->id,
                            'uuid' => $first->uuid,
                            'outsourcings' => [
                                'name' => $first->outsourcings->name,
                                'jabatan' => optional($first->outsourcings->jabatan)->nama_jabatan,
                                'image' => $first->outsourcings->image,
                            ],
                            'status' => $first->status,
                            'tipe_penilai' => $first->tipe_penilai,
                            'score' => $rekap['finalTotalScore'],
                        ];
                    })
                    ->values();


                return [
                    'id' => $siklus->uuid,
                    'name' => $siklus->title,
                    'period' => sprintf(
                        '%s - %s',
                        optional($siklus->tanggal_mulai)->translatedFormat('F Y'),
                        optional($siklus->tanggal_selesai)->translatedFormat('F Y'),
                    ),
                    'status' => $siklus->is_active ? 'active' : 'completed',
                    'employees' => $employees,
                ];
            })
            ->values();

        //----------------------------------------------------------

        $user = Auth::user();

        /** @var Outsourcing $outsourcing */
        $outsourcing = $user->userable;

        $siklusAktif = Siklus::query()
            ->where('is_active', true)
            ->first();

        $penugasan = PenugasanPenilai::query()
            ->where('outsourcing_id', $outsourcing->id)
            ->where('siklus_id', $siklusAktif->id)
            ->with([
                'bobotSkor',
                'evaluators.userable',
                'penilian.kriteria.aspek.bobotSkor',
            ])
            ->get();

        $hasil = app(RekapHasilService::class)->hitung($penugasan);

        $typeUser = Auth::user()->userable_type === Outsourcing::class ? 'outsourcing' : 'pegawai';

        $data = [
            'semesterHistory' => $semesterHistory,
            'penugasanPeer' => Auth::user()->penugasan()
                ->select(['outsourcing_id', 'siklus_id', 'status', 'uuid', 'tipe_penilai'])
                ->whereHas('siklus', fn($q) => $q->where('is_active', true))
                ->with(['siklus', 'outsourcings'])
                ->get(),
            'ressultScore' => $typeUser == 'outsourcing' ? $hasil : null,
            'typeUser' => $typeUser,
        ];

        return Inertia::render('evaluator/page', $data);
    }

    public function byOutsourcings(): Response
    {
        $outsourcings = Outsourcing::with([
            'penugasan.evaluators.userable',
        ])
            ->orderBy('name', 'asc')
            ->where('is_active', 1)
            ->get()
            ->map(function ($os) {


                return [
                    'outsourcing_name' => $os->name,
                    'outsourcing_image' => $os->image,
                    'outsourcing_jabatan' => optional($os->jabatan)->nama_jabatan,
                    'evaluatorsAtasan' => [
                        'name' => $os->penugasan->firstWhere('tipe_penilai', 'atasan')?->evaluators?->userable?->name,
                        'image' => $os->penugasan->firstWhere('tipe_penilai', 'atasan')?->evaluators?->userable?->image,
                        'uuid' => $os->penugasan->firstWhere('tipe_penilai', 'atasan')?->evaluators?->userable?->uuid,
                        'status' => $os->penugasan->firstWhere('tipe_penilai', 'atasan')?->status,
                    ],
                    'evaluatorsTemanSetingkat' => [
                        'name' => $os->penugasan->firstWhere('tipe_penilai', 'teman_setingkat')?->evaluators?->userable?->name,
                        'image' => $os->penugasan->firstWhere('tipe_penilai', 'teman_setingkat')?->evaluators?->userable?->image,
                        'uuid' => $os->penugasan->firstWhere('tipe_penilai', 'teman_setingkat')?->evaluators?->userable?->uuid,
                        'status' => $os->penugasan->firstWhere('tipe_penilai', 'teman_setingkat')?->status,
                    ],
                    'evaluatorsPenerimaLayanan' => [
                        'name' => $os->penugasan->firstWhere('tipe_penilai', 'penerima_layanan')?->evaluators?->userable?->name,
                        'image' => $os->penugasan->firstWhere('tipe_penilai', 'penerima_layanan')?->evaluators?->userable?->image,
                        'uuid' => $os->penugasan->firstWhere('tipe_penilai', 'penerima_layanan')?->evaluators?->userable?->uuid,
                        'status' => $os->penugasan->firstWhere('tipe_penilai', 'penerima_layanan')?->status,
                    ],
                ];
            });

        return Inertia::render('admin/statuspenilaian/ETXpenilaianByOutsourcing', [
            'outsourcings' => $outsourcings,
        ]);
    }

    public function byEvaluators(): Response
    {
        $evaluators = PenugasanPenilai::select(['siklus_id', 'status', 'outsourcing_id', 'penilai_id', 'tipe_penilai'])
            ->whereHas('siklus', fn($q) => $q->where('is_active', 1))
            ->withOnly([
                'outsourcings:id,name,uuid,image,jabatan_id,nip',
                'evaluators.userable',
            ])
            ->get()
            ->map(function ($item) {
                $userable = $item->evaluators?->userable;

                return [
                    'outsourcing_name' => $item->outsourcings->name,
                    'outsourcing_image' => $item->outsourcings->image,
                    'outsourcing_jabatan' => optional($item->outsourcings->jabatan)->nama_jabatan,
                    'tipe_penilai' => $item->tipe_penilai,
                    'status' => $item->status,
                    'evaluator_name' => $userable?->name,
                    'evaluator_image' => $userable?->image,
                    'evaluator_uuid' => $userable?->uuid,
                ];
            });

        return Inertia::render('admin/statuspenilaian/ETXpenilaianByEvaluator', [
            'evaluators' => $evaluators,
        ]);
    }

    public function statusPenilaian(): Response
    {
        return Inertia::render('admin/statuspenilaian/page');
    }

    public function reset(PenugasanPenilai $PenugasanPenilai)
    {
        foreach ($PenugasanPenilai->penilian as $key => $penugasan) {
            $penugasan->delete();
        };

        $PenugasanPenilai->update([
            'catatan' => null,
            'status' => 'incomplete',
        ]);
    }

    public function saranPerbaikan(SaranPerbaikanEvaluator $service): Response
    {
        $data = [
            'Outsourcings' => $service->saran()
        ];

        return Inertia::render('admin/saranperbaikan/page', $data);
    }
}
