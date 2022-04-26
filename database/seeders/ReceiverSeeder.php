<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receivers')->insert([
            [
                'name' => 'Persona 1',
                'nit' => '900190040-1',
            ],
            [
                'name' => 'Persona 2',
                'nit' => '900190040-1',
            ],
            [
                'name' => 'Persona 3',
                'nit' => '900190040-1',
            ],
        ]);
    }
}
