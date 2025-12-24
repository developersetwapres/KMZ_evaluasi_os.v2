<?php

namespace App\Http\Controllers;

use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use function Termwind\render;

class UserController extends Controller
{
    public function index(): Response
    {
        $masterPegawais = MasterPegawai::where('kode_unit', 02)
            ->orderBy('name', 'asc')
            ->with('biro')
            ->get()
            ->map(fn($p) => [
                'id'   => $p->uuid,
                'name' => $p->name,
                'type' => 'pegawai',
                'biro' => $p->biro?->name,
                'jabatan' => $p->jabatan,
            ]);

        $outsourcings = Outsourcing::with(['biro', 'jabatan'])
            ->orderBy('name', 'asc')
            ->get()
            ->map(fn($o) => [
                'id'      => $o->uuid,
                'name'    => $o->name,
                'type'    => 'outsourcing',
                'biro'    => $o->biro?->nama_biro,
                'jabatan' => $o->jabatan?->nama_jabatan,
            ]);

        $data = [
            'initialUsers' => $outsourcings->concat($masterPegawais),
        ];


        return Inertia::render('admin/user/page', $data);
    }
}
