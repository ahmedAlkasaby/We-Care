<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Transfer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransferItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transfer::each(function ($transfer) {
            $transfer->items()->attach(
                Item::inRandomOrder()->first()->id,
                ['amount' => rand(1, 10)]
            );
        });
    }
}
