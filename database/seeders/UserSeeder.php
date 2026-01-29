<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $penjagaanRole = Role::where('name', 'penjagaan')->first();
        $mesinRole = Role::where('name', 'mesin')->first();

        // Create admin user
        User::create([
            'name' => 'ADMIN',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'role_id' => $adminRole->id,
        ]);

        // Create mesin users
        User::create([
            'name' => 'MARGUNA',
            'email' => 'marguna@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'SOIM',
            'email' => 'soim@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'PARTHAGUNA',
            'email' => 'parthaguna@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'BAYU',
            'email' => 'bayu@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'RESA',
            'email' => 'resa@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'LIWA',
            'email' => 'liwa@mesin',
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        User::create([
            'name' => 'SUWITRA',
            'email' => 'suwitra@mesin',  
            'password' => Hash::make('mesin'),
            'role_id' => $mesinRole->id,
        ]);

        // Create penjaga users
        User::create([
            'name' => 'SIUS',
            'email' => 'sius@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'SEBASTIAN',
            'email' => 'sebastian@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'DARMA',
            'email' => 'darma@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'CARITA',
            'email' => 'carita@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'UTAMA',
            'email' => 'utama@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'LORENSIUS',
            'email' => 'lorensius@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'ALDI',
            'email' => 'aldi@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'MAHARDIKA',
            'email' => 'mahardika@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'YULEX',
            'email' => 'yulex@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'YOHANES',
            'email' => 'yohanes@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'MERTA',
            'email' => 'merta@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'ANDRE',
            'email' => 'andre@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);

        User::create([
            'name' => 'ARTAWAN',
            'email' => 'artawan@penjaga',
            'password' => Hash::make('penjaga'),
            'role_id' => $penjagaanRole->id,
        ]);
    }
}
