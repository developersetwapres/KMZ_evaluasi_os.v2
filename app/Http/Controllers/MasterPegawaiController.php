<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\MasterPegawai;
use App\Services\Uploadfile\FotoUserService;

class MasterPegawaiController extends Controller
{
    public function update(UpdatePegawaiRequest $request, MasterPegawai $pegawai, FotoUserService $service)
    {
        $finalImagePath = $service->moveImageFromTemp($request->image, 'asn');

        $pegawai->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'kode_biro' => $request->unit_kerja,
            'image' => $finalImagePath ?? 'foto_default.png',
        ]);


        return redirect()->back()->with('success', 'Data Outsourcing berhasil diperbarui.');
    }
}
