<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sport::create([
            'name' => 'كرة قدم',
        ]);
        Sport::create([
            'name' => 'كرة سلة',
        ]);
        Sport::create([
            'name' => 'كرة طائرة',
        ]);
        Sport::create([
            'name' => 'سباحة',
        ]);

    }
}
