<?php
namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use App\Models\Country;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
           'name'=>'الضربات الثابتة',
           'sport_id'=>1
        ]);
        Activity::create([
           'name'=>'ضربات الرأس',
           'sport_id'=>1
        ]);
        Activity::create([
           'name'=>'الركض',
           'sport_id'=>1
        ]);
        Activity::create([
           'name'=>'ضربات الجزاء',
           'sport_id'=>1
        ]);
        Activity::create([
           'name'=>'تمرينات عامة',
           'sport_id'=>1
        ]);
    }
}
