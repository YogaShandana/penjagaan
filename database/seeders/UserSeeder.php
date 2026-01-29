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
    }
}
