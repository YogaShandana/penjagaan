<?php

namespace Database\Seeders;

use App\Models\Mjs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MjsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MJS Mesin - 3 pos
        Mjs::create([
            'nama_post' => 'Post 1',
            'nomor_urut' => 1,
            'qr_token' => 'mjs-mesin-0001-0000-0000-000000000001',
            'role_type' => 'mesin'
        ]);

        Mjs::create([
            'nama_post' => 'Post 2',
            'nomor_urut' => 2,
            'qr_token' => 'mjs-mesin-0002-0000-0000-000000000002',
            'role_type' => 'mesin'
        ]);

        Mjs::create([
            'nama_post' => 'Post 3',
            'nomor_urut' => 3,
            'qr_token' => 'mjs-mesin-0003-0000-0000-000000000003',
            'role_type' => 'mesin'
        ]);

        // MJS Penjaga - 5 pos
        Mjs::create([
            'nama_post' => 'Post 1',
            'nomor_urut' => 1,
            'qr_token' => 'mjs-penjaga-001-0000-0000-000000000001',
            'role_type' => 'penjaga'
        ]);

        Mjs::create([
            'nama_post' => 'Post 2',
            'nomor_urut' => 2,
            'qr_token' => 'mjs-penjaga-002-0000-0000-000000000002',
            'role_type' => 'penjaga'
        ]);

        Mjs::create([
            'nama_post' => 'Post 3',
            'nomor_urut' => 3,
            'qr_token' => 'mjs-penjaga-003-0000-0000-000000000003',
            'role_type' => 'penjaga'
        ]);

        Mjs::create([
            'nama_post' => 'Post 4',
            'nomor_urut' => 4,
            'qr_token' => 'mjs-penjaga-004-0000-0000-000000000004',
            'role_type' => 'penjaga'
        ]);

        Mjs::create([
            'nama_post' => 'Post 5',
            'nomor_urut' => 5,
            'qr_token' => 'mjs-penjaga-005-0000-0000-000000000005',
            'role_type' => 'penjaga'
        ]);
    }
}
