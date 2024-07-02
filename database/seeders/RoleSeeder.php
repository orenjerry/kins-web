<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Owner'],
            ['name' => 'Admin'],
            ['name' => 'User'],
        ];

        Role::truncate();

        foreach ($roles as $role) {
            Role::insert([
                'name' => $role['name'],
                'created_at' => Carbon::now(), // Set the created_at timestamp
            ]);
        }
    }
}

