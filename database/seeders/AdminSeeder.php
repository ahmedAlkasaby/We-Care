<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin1=User::create([
            'name'=>'ahmed',
            'phone'=>"01016192604",
            'password'=>Hash::make('ahmed145'),
            'role'=>'admin',
            'is_admin'=>1,
        ]);

        $admin1->addRole('admin');

        $admin2=User::create([
            'name'=>'osama',
            'phone'=>"01006823837",
            'password'=>Hash::make('123123123'),
            'role'=>'admin',
            'is_admin'=>1,
        ]);

        $admin2->addRole('admin');
    }
}
