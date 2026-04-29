<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'sid' => 'admin_test',
            'password' => Hash::make('admin'),
            'pass' => 'admin',
            'aktif' => 1,
            'tingkat' => 1,
            'induk' => 1,
            'jumlahlogin' => 0,
            'tslogin' => 0,
            'tslogout' => 0,
            'ip' => 0,
            'id_ps' => (int)env('PRODI_ID')
        ]);
    }
}
