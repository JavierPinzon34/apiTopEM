<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransmitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transmitters')->insert([
            [
                'name' => 'Persona 4',
                'nit' => '400650487-1',
            ],
            [
                'name' => 'Persona 5',
                'nit' => '700650487-1',
            ],
            [
                'name' => 'Persona 6',
                'nit' => '900199945-1',
            ],
        ]);
    }
}
