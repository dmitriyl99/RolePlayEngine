<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'name' => 'За Периметром'
        ]);
        Area::create([
            'name' => 'Периметр'
        ]);
        Area::create([
            'name' => 'Южные Земли'
        ]);
        Area::create([
            'name' => 'Магистраль'
        ]);
        Area::create([
            'name' => 'Северные земли'
        ]);
    }
}
