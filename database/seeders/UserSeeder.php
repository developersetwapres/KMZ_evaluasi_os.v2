<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'id' => '2',
                'nip' => 'Adm1n1str4t0r_',
                'nip_sso' => 'Adm1n1str4t0r_',
                'is_ldap' => '0',
                'email' => 'admin.evaluasi.os@set.wapresri.go.id',
                'password' => 'Adm1n1str4t0r_',
                'remember_token' => NULL,
                'created_at' => '2025-11-18 16:10:57',
                'updated_at' => '2025-11-18 16:10:57'
            ],
            [
                'id' => '3928',
                'nip' => '199909212025062006',
                'nip_sso' => '199909212025062006',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '3929',
                'nip' => '199107092025062003',
                'nip_sso' => '199107092025062003',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '3930',
                'nip' => '200105012025061007',
                'nip_sso' => '200105012025061007',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '3931',
                'nip' => '199809182025062006',
                'nip_sso' => '199809182025062006',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '3932',
                'nip' => '199601192025062006',
                'nip_sso' => '199601192025062006',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '3933',
                'nip' => '200105252025061008',
                'nip_sso' => '200105252025061008',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '4113',
                'nip' => '198705272025211057',
                'nip_sso' => '198705272025211057',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '4114',
                'nip' => '198507192025212034',
                'nip_sso' => '198507192025212034',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => '4115',
                'nip' => '199011292025211051',
                'nip_sso' => '199011292025211051',
                'is_ldap' => '1',
                'email' => NULL,
                'password' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ]
        ];

        foreach ($data  as $key => $value) {
            User::create(
                [
                    'id'      => $value['nip'],
                    'nip'      => $value['nip'],
                    'nip_sso'  => $value['nip_sso'],
                    'is_ldap'  => $value['is_ldap'],
                    'email'  => $value['email'],
                    'password'  => $value['password'],
                ]
            );
        }
    }
}
