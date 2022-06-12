<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = ['Vilnius', 'Druskininkai', 'Kaunas', 'Klaipėda', 'Šiauliai'];
        foreach($cities as $city){
            DB::table('cities')->insert([
                'name' => $city,
            ]);
        }

    }
}
