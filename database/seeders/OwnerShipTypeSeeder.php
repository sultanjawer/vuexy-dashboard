<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerShipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner_ships_types = ['1', '2', '3'];

        foreach ($owner_ships_types  as $owner_ships_type) {
            DB::table('owner_ship_types')->insert([
                'name' => $owner_ships_type,
                'created_at' => now(),
            ]);
        }
    }
}
