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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create penjagaan user
        User::create([
            'name' => 'Penjaga',
            'email' => 'penjaga@penjaga.com',
            'password' => Hash::make('password'),
            'role_id' => $penjagaanRole->id,
        ]);

        // Create mesin user
        User::create([
            'name' => 'Mesin',
            'email' => 'mesin@mesin.com',
            'password' => Hash::make('password'),
            'role_id' => $mesinRole->id,
        ]);
    }
}
