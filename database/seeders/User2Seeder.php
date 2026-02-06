<?php

namespace Database\Seeders;

use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use App\Models\User;
use Illuminate\Database\Seeder;

class User2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => '1002',
                'nip' => 'NA202506199903',
                'nip_sso' => 'vendor.khaeril',
                'is_ldap' => '1',
                'role'  => ['administrator', 'operator'],
                'email' => NULL,
                'password' => NULL,
            ],
        ];

        $masterNips = Outsourcing::pluck('nip')->toArray();

        foreach ($users as $value) {
            if (!in_array($value['nip'], $masterNips)) {
                continue; // skip user yg NIP-nya tidak ada
            }

            User::updateOrCreate(
                ['nip' => $value['nip']],
                [
                    'nip_sso' => $value['nip_sso'],
                    'userable_id' => $value['nip'],
                    'userable_type' => MasterPegawai::class,
                    'role' => $value['role'] ?? ['evaluator'],
                    'is_ldap' => $value['is_ldap'],
                    'email' => $value['email'],
                    'password' => $value['password'],
                ]
            );
        }
    }
}
