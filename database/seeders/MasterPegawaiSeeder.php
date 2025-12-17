<?php

namespace Database\Seeders;

use App\Models\MasterPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $master_pegawais = [
            [
                'id' => '1',
                'nip' => 'Developer165#',
                'name' => 'Developer Setwapres',
                'kode_instansi' => NULL,
                'kode_unit' => '02',
                'kode_deputi' => NULL,
                'kode_biro' => '0239',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => NULL,
                'created_at' => '2025-11-18 15:56:47',
                'updated_at' => '2025-11-18 15:56:47'
            ],
            [
                'id' => '2',
                'nip' => 'Adm1n165#@',
                'name' => 'Admin ATK',
                'kode_instansi' => NULL,
                'kode_unit' => '02',
                'kode_deputi' => NULL,
                'kode_biro' => '0239',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => NULL,
                'created_at' => '2025-11-18 15:56:47',
                'updated_at' => '2025-11-18 15:56:47'
            ],
            [
                'id' => '3',
                'nip' => 'Adm1n773#@',
                'name' => 'Admin Gedung',
                'kode_instansi' => NULL,
                'kode_unit' => '02',
                'kode_deputi' => NULL,
                'kode_biro' => '0239',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => NULL,
                'created_at' => '2025-11-18 15:56:48',
                'updated_at' => '2025-11-18 15:56:48'
            ],
            [
                'id' => '4',
                'nip' => 'Adm1n945#@',
                'name' => 'Admin Ruangan',
                'kode_instansi' => NULL,
                'kode_unit' => '02',
                'kode_deputi' => NULL,
                'kode_biro' => '0239',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => NULL,
                'created_at' => '2025-11-18 15:56:48',
                'updated_at' => '2025-11-18 15:56:48'
            ],
            [
                'id' => '5',
                'nip' => 'User165#',
                'name' => 'User Layanan Biro Umum',
                'kode_instansi' => NULL,
                'kode_unit' => '02',
                'kode_deputi' => NULL,
                'kode_biro' => '0239',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => NULL,
                'created_at' => '2025-11-18 15:56:48',
                'updated_at' => '2025-11-18 15:56:48'
            ],
            [
                'id' => '6',
                'nip' => '00010015',
                'name' => 'Briptu Mellinia Fitrika Irajyanti, S.S.',
                'kode_instansi' => '0',
                'kode_unit' => '02',
                'kode_deputi' => '027',
                'kode_biro' => '0234',
                'kode_bagian' => '02340',
                'kode_subbagian' => '023400',
                'jabatan' => 'Petugas Protokol Kepresidenan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '7',
                'nip' => '198012032000121001',
                'name' => 'Sandra Erawanto, S.STP., M.Pub.Pol.',
                'kode_instansi' => '0',
                'kode_unit' => '06',
                'kode_deputi' => '066',
                'kode_biro' => NULL,
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Analis Sumber Daya Manusia Aparatur',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '8',
                'nip' => '01050182',
                'name' => 'Briptu Putu Bintang Seviana Dewi, S.H.',
                'kode_instansi' => '0',
                'kode_unit' => '02',
                'kode_deputi' => '027',
                'kode_biro' => '0234',
                'kode_bagian' => '02340',
                'kode_subbagian' => '023400',
                'jabatan' => 'Petugas Protokol Kepresidenan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '9',
                'nip' => '197412291998031005',
                'name' => 'Muhammad David Masri, S.Sos., M.H.',
                'kode_instansi' => '0',
                'kode_unit' => '02',
                'kode_deputi' => '027',
                'kode_biro' => '0235',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Pranata Humas Ahli Madya',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '10',
                'nip' => '196606021992031004',
                'name' => 'Drs. Rusmin Nuryadin, M.H.',
                'kode_instansi' => '0',
                'kode_unit' => '02',
                'kode_deputi' => '027',
                'kode_biro' => '0235',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Kepala Biro Pers, Media, dan Informasi',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '11',
                'nip' => '197405171998032001',
                'name' => 'Tuti Trihastuti Sukardi, S.H., M.Si., M.H.',
                'kode_instansi' => '170',
                'kode_unit' => '22',
                'kode_deputi' => NULL,
                'kode_biro' => NULL,
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Analis Hukum',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '12',
                'nip' => '197004151996031001',
                'name' => 'Bey Triadi Machmudin, S.E., M.T.',
                'kode_instansi' => '0',
                'kode_unit' => '07',
                'kode_deputi' => '070',
                'kode_biro' => NULL,
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Staf Ahli Bidang Politik, Pertahanan dan Keamanan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '13',
                'nip' => '07071983',
                'name' => 'dr. Michael Wicaksono, M.Med.',
                'kode_instansi' => '0',
                'kode_unit' => '03',
                'kode_deputi' => '034',
                'kode_biro' => '0340',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Dokter Pribadi Presiden/Wakil Presiden',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '14',
                'nip' => '101624',
                'name' => 'Koptu Lis Elo Kustoro',
                'kode_instansi' => '0',
                'kode_unit' => '03',
                'kode_deputi' => '031',
                'kode_biro' => '0313',
                'kode_bagian' => '03132',
                'kode_subbagian' => NULL,
                'jabatan' => 'Petugas Keamanan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '15',
                'nip' => '104871',
                'name' => 'Pelda Mar (Inf) Nono Darsono, S.H.',
                'kode_instansi' => '0',
                'kode_unit' => '03',
                'kode_deputi' => '030',
                'kode_biro' => '0304',
                'kode_bagian' => '03041',
                'kode_subbagian' => NULL,
                'jabatan' => 'Petugas Protokol',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '16',
                'nip' => '108308',
                'name' => 'Serma Pipit Sere',
                'kode_instansi' => '0',
                'kode_unit' => '02',
                'kode_deputi' => '027',
                'kode_biro' => '0234',
                'kode_bagian' => '02340',
                'kode_subbagian' => '023400',
                'jabatan' => 'Petugas Protokol Kepresidenan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '17',
                'nip' => '11000060790479',
                'name' => 'Kolonel Caj Sandy, S.I.P., M.Si.(Han], M.S.I.',
                'kode_instansi' => '0',
                'kode_unit' => '03',
                'kode_deputi' => '032',
                'kode_biro' => '0323',
                'kode_bagian' => NULL,
                'kode_subbagian' => NULL,
                'jabatan' => 'Kepala Bagian Penganugerahan',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '18',
                'nip' => '11010028530375',
                'name' => 'Letkol Caj (K)  Susilawati, S.S.',
                'kode_instansi' => '0',
                'kode_unit' => '03',
                'kode_deputi' => '030',
                'kode_biro' => '0303',
                'kode_bagian' => '03032',
                'kode_subbagian' => NULL,
                'jabatan' => 'Kepala Subbagian Pemberhentian',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
        ];

        foreach ($master_pegawais as $key => $value) {
            MasterPegawai::create([
                'nip' => $value['nip'],
                'name' => $value['name'],
                'kode_instansi' => $value['kode_instansi'],
                'kode_unit' => $value['kode_unit'],
                'kode_deputi' => $value['kode_deputi'],
                'kode_biro' => $value['kode_biro'],
                'kode_bagian' => $value['kode_bagian'],
                'kode_subbagian' => $value['kode_subbagian'],
                'jabatan' => $value['jabatan'],
            ]);
        }
    }
}
