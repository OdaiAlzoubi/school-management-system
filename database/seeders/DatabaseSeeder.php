<?php

namespace Database\Seeders;

use App\Enum\GenderEnum;
use App\Enum\RoleEnum;
use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'national_number' => '1234567890',
            'date_of_birth' => '1990-01-01',
            'role' => RoleEnum::SUPERADMINISTRATOR->value,
            'gender' => GenderEnum::MALE->value,
            'is_active' => true,
            'address' => json_encode([
                'city' => 'test',
                'street' => 'test',
                'country' => 'test'
            ]),
            'password' => ('admin')
        ]);
    }
}
