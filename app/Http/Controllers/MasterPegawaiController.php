<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\MasterPegawai;
use Illuminate\Support\Facades\DB;

class MasterPegawaiController extends Controller
{
    public function update(UpdatePegawaiRequest $request, MasterPegawai $pegawai)
    {
        dd($request);
        DB::transaction(function () use ($request, $outsourcing) {
            $moveImageFromTemp = app(UploadController::class)->moveImageFromTemp(...);
            $finalImagePath = $moveImageFromTemp($request->image, 'os');

            $outsourcing->update([
                'name' => $request->name,
                'jabatan_id' => $request->jabatan,
                'kode_biro' => $request->unit_kerja,
                'is_active' => $request->status,
                'image' => $finalImagePath,
            ]);

            $userData = [
                'email' => $request->email,
            ];


            $outsourcing->user->update($userData);
        });

        return redirect()->back()->with('success', 'Data Outsourcing berhasil diperbarui.');
    }
}
