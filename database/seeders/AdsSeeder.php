<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* Ad::create([
            'title' => 'Web Development Services',
            'text' => 'Professional web development services using Laravel.',
            'phone' => '01012345678',
            'user_id' => 1,
            'domain_id' => 1,
        ]);

        Ad::create([
            'title' => 'Mobile Repair',
            'text' => 'Fast and reliable mobile phone repair services.',
            'phone' => '01098765432',
            'user_id' => 1,
            'domain_id' => 1,
        ]);
*/
        for ($i = 1; $i <= 5; $i++) {
            Ad::create([
                'title' => "Ad domain 2 {$i}",
                'text' => "This is the description for ad number {$i}.",
                'phone' => '01012345678',
                'user_id' => 2,
                'domain_id' => 2,
            ]);
        }
    }
}
