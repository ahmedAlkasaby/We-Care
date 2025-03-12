<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'doner',
            'display_name' => 'Doner',
            'description' => 'doner ',
            'is_admin'=>0,
        ]);
        Role::create([
            'name' => 'volunteer',
            'display_name' => 'Volunteer',
            'description' => 'volunteer',
            'is_admin'=>0,

        ]);
        Role::create([
            'name' => 'case',
            'display_name' => 'Case',
            'description' => 'case',
            'is_admin'=>0,
        ]);
    }
}
