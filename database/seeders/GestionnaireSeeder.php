<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GestionnaireSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'gestionnaire@example.com'],
            [
                'name' => 'Gestionnaire',
                'password' => Hash::make('passer@1'),
                'role' => 'gestionnaire',
            ]
        );
    }
}
