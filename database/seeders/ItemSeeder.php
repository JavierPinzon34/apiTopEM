<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => 'Articulo 1',
                'quantity' => 1000,
                'unit_value' => 1000.00
            ],
            [
                'name' => 'Articulo 2',
                'quantity' => 1000,
                'unit_value' => 1000.00
            ],
            [
                'name' => 'Articulo 3',
                'quantity' => 1000,
                'unit_value' => 1000.00
            ],
            [
                'name' => 'Articulo 4',
                'quantity' => 1000,
                'unit_value' => 1000.00
            ],
            [
                'name' => 'Articulo 5',
                'quantity' => 1000,
                'unit_value' => 1000.00
            ],

        ]);
    }
}
