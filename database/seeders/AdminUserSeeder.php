<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@poltekpel-barombong.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'Administrator',
        ]);

        User::create([
            'name' => 'Bagian Akademik',
            'email' => 'akademik@poltekpel-barombong.ac.id',
            'password' => Hash::make('akademik123'),
            'role' => 'Akademik',
        ]);

        User::create([
            'name' => 'Koordinator Instruktur',
            'email' => 'instruktur@poltekpel-barombong.ac.id',
            'password' => Hash::make('instruktur123'),
            'role' => 'Instruktur',
        ]);
    }
}
