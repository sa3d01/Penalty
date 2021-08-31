<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ad::create([
            'name' => 'facebook',
        ]);
        Ad::create([
            'name' => 'twitter',
        ]);
        Ad::create([
            'name' => 'صديق',
        ]);

    }
}
