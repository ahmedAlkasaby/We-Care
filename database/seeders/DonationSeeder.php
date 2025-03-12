<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\CharityCase;
use App\Traits\DonationTrait;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonationSeeder extends Seeder
{
    use DonationTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // during a year
        for ($i = 0; $i < 10; $i++) {
            $donation = Donation::create([
                'doner_id' => User::inRandomOrder()->where('role', 'doner')->first()->id,
                'case_id' => CharityCase::inRandomOrder()->first()->id,
                'payment_id' => Payment::inRandomOrder()->first()->id,
                'price' => rand(100, 1000),
                'confirm' => 1,
                'type'=>'price',
                'created_at' => now()->subDays(rand(1, 365)),
            ]);
            $doner=User::find($donation->doner_id);
            $doner->update([
                'amount'=>$doner->amount + $donation->get_price()
            ]);
            $donation->images()->create([
                'image'=>'donation_images\donation_from_charity.png'
            ]);
        }

        // during the last 10 days
        // for ($i = 0; $i < 16; $i++) {
        //     $donation = Donation::create([
        //         'doner_id' => User::inRandomOrder()->where('role', 'doner')->first()->id,
        //         'case_id' => CharityCase::inRandomOrder()->first()->id,
        //         'payment_id' => Payment::inRandomOrder()->first()->id,
        //         'price' => rand(100, 1000),
        //         'confirm' => rand(0,1),
        //         'type'=>'price',
        //         'created_at' => now()->subDays(rand(1, 10)), // This line ensures the created_at field varies around the past 10 days
        //     ]);

        //     $doner=User::find($donation->doner_id);
        //     $doner->update([
        //         'amount'=>$doner->amount + $donation->get_price()
        //     ]);

        // }
    }
}
