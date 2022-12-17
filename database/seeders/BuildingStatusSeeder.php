<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'قائم',
            'تحت الإنشاء',
        ];

        foreach ($names as $name) {
            DB::table('building_statuses')->insert([
                'name' => $name
            ]);
        }
    }
}
