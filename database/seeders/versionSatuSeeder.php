<?php

namespace Database\Seeders;

use App\Models\MasterPegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class versionSatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $pegawai = [
                'nip' => '196604171992022001',
                'name' => 'Drg. Paula Fanny Hartono',
                'kode_instansi' => '0',
                'kode_unit' => '00',
                'kode_deputi' => '156',
                'kode_biro' => null,
                'kode_bagian' => null,
                'kode_subbagian' => null,
                'jabatan' => 'Dokter Gigi Ahli Madya',
                'image' => '',
            ];

            MasterPegawai::create([
                'id' => $pegawai['nip'],
                'nip' => $pegawai['nip'],
                'name' => $pegawai['name'],
                'image' => 'images/asn/' . $pegawai['nip'] . '.jpg',
                'kode_instansi' => $pegawai['kode_instansi'],
                'kode_unit' => '02',
                'kode_deputi' => $pegawai['kode_deputi'],
                'kode_biro' => $pegawai['kode_biro'],
                'kode_bagian' => $pegawai['kode_bagian'],
                'kode_subbagian' => $pegawai['kode_subbagian'],
                'jabatan' => $pegawai['jabatan'],
            ]);

            $akunSso = [
                'nip' => '196604171992022001',
                'nip_sso' => '140275437',
                'is_ldap' => 1,
            ];

            User::updateOrCreate(
                ['nip' => $akunSso['nip']],
                [
                    'nip_sso' => $akunSso['nip_sso'],
                    'userable_id' => $akunSso['nip'],
                    'userable_type' => MasterPegawai::class,
                    'role' => 'evaluator',
                    'is_ldap' => $akunSso['is_ldap'],
                ]
            );
        });
    }
}
