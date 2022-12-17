<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'متصل',
            'منفصل',
            'شبه منفصل',
        ];

        foreach ($names as $name) {
            DB::table('building_types')->insert([
                'name' => $name
            ]);
        }
    }
}
