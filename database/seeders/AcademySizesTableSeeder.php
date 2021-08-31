<?php

namespace Database\Seeders;

use App\Models\AcademySize;
use Illuminate\Database\Seeder;

class AcademySizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademySize::create([
            'name' => 'مدرب خاص',
        ]);
        AcademySize::create([
            'name' => 'صغير (حتي ٧٠ لاعب)',
        ]);
        AcademySize::create([
            'name' => 'متوسط (حتي ٢٥٠ لاعب)',
        ]);
        AcademySize::create([
            'name' => 'فوق المتوسط (حتي ٥٠٠ لاعب)',
        ]);
        AcademySize::create([
            'name' => 'كبير (أكبر من ٥٠٠ لاعب)',
        ]);

    }
}
