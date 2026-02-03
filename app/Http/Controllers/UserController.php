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
    public function index($user): Response
    {
        if ($user == 'outsourcings') {
            $initialUsers = Outsourcing::with(['biro', 'jabatan'])
                ->orderBy('name', 'asc')
                ->with('user')
                ->get()
                ->map(fn($o) => [
                    'id'      => $o->uuid,
                    'name'    => $o->name,
                    'image'    => $o->image,
                    'nip'     => $o->user?->nip,
                    'email'     => $o->user?->email,
                    'role'     => $o->user?->role,
                    'is_active'     => $o->is_active,
                    'type'    => 'outsourcing',
                    'biro'    => $o->biro?->nama_biro,
                    'jabatan' => $o->jabatan?->nama_jabatan,
                ]);
        } elseif ($user == 'evaluators') {
            $initialUsers = MasterPegawai::where('kode_unit', '02')
                ->orderBy('name', 'asc')
                ->with(['biro', 'user'])
                ->get()
                ->map(fn($p) => [
                    'id'        => $p->uuid,
                    'name'      => $p->name,
                    'image'    => $p->image,
                    'email'     => null,
                    'type'      => 'pegawai',
                    'nip'       => $p->user?->nip_sso,
                    'biro'      => $p->biro?->nama_biro,
                    'role'     => $p->user?->role,
                    'jabatan'   => $p->jabatan,
                ]);
        } else {
            $initialUsers = [];
        }

        $data = [
            'initialUsers' => $initialUsers,
            'totalOutsourcing' => Outsourcing::count(),
            'outsourcingAktif' => Outsourcing::where('is_active', 1)->count(),
            'outsourcingNonAktif' => Outsourcing::where('is_active', 0)->count(),
        ];

        return Inertia::render('admin/user/page', $data);
    }
}
