<?php

namespace Database\Seeders;

use App\Models\Ims;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IMS Mesin - 3 pos
        Ims::create([
            'nama_post' => 'Post 1',
            'nomor_urut' => 1,
            'qr_code' => 'IMS-M-001',
            'qr_token' => 'ims-mesin-0001-0000-0000-000000000001',
            'role_type' => 'mesin'
        ]);

        Ims::create([
            'nama_post' => 'Post 2',
            'nomor_urut' => 2,
            'qr_code' => 'IMS-M-002',
            'qr_token' => 'ims-mesin-0002-0000-0000-000000000002',
            'role_type' => 'mesin'
        ]);

        Ims::create([
            'nama_post' => 'Post 3',
            'nomor_urut' => 3,
            'qr_code' => 'IMS-M-003',
            'qr_token' => 'ims-mesin-0003-0000-0000-000000000003',
            'role_type' => 'mesin'
        ]);

        // IMS Penjaga - 4 pos
        Ims::create([
            'nama_post' => 'Post 1',
            'nomor_urut' => 1,
            'qr_code' => 'IMS-P-001',
            'qr_token' => 'ims-penjaga-001-0000-0000-000000000001',
            'role_type' => 'penjaga'
        ]);

        Ims::create([
            'nama_post' => 'Post 2',
            'nomor_urut' => 2,
            'qr_code' => 'IMS-P-002',
            'qr_token' => 'ims-penjaga-002-0000-0000-000000000002',
            'role_type' => 'penjaga'
        ]);

        Ims::create([
            'nama_post' => 'Post 3',
            'nomor_urut' => 3,
            'qr_code' => 'IMS-P-003',
            'qr_token' => 'ims-penjaga-003-0000-0000-000000000003',
            'role_type' => 'penjaga'
        ]);

        Ims::create([
            'nama_post' => 'Post 4',
            'nomor_urut' => 4,
            'qr_code' => 'IMS-P-004',
            'qr_token' => 'ims-penjaga-004-0000-0000-000000000004',
            'role_type' => 'penjaga'
        ]);
    }
}
