<?php

namespace Database\Seeders;

use App\Emplois;
use Illuminate\Database\Seeder;

class EmploisSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Emplois::class, 10)->create();

        foreach (Emplois::all() as $emplois){
            $skyles = \App\skyles::inRandom()->take(rand(1,3))->pluck('id');
            $emplois->skyles()->attach($skyles);
        }
    }
}
