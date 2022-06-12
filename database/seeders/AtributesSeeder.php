<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atributes = [
            'pool' => 'Baseinas',
            'bath' => 'Pirtis',
            'food' => 'Maistas',
            'drinks' => 'Gerimai'
        ];
        foreach($atributes as $key => $atribute){

            DB::table('atributes')->insert([
                'name' => $key,
                'label' => $atribute
            ]);
        }
    }
}
