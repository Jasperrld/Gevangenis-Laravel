<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maatschappelijkwerker = User::factory()->create([
            'name' => 'maatschappelijkwerker',
            'email' => 'maatschappelijkwerker@example.com',
            'password' => Hash::make('password'),
        ]);
        $maatschappelijkwerker->assignRole('maatschappelijkwerker');

        $opnameofficier = User::factory()->create([
            'name' => 'opnameofficier',
            'email' => 'opnameofficier@example.com',
            'password' => Hash::make('password'),
        ]);
        $opnameofficier->assignRole('opnameofficier');

        $portier = User::factory()->create([
            'name' => 'portier',
            'email' => 'portier@example.com',
            'password' => Hash::make('password'),
        ]);
        $portier->assignRole('portier');

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');


    }
}
