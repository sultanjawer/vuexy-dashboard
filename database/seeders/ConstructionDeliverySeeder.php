<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstructionDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'عظم',
            'تسليم 50%',
            'تسليم مفتاح',
        ];

        foreach ($names as $name) {
            DB::table('construction_deliveries')->insert([
                'name' => $name
            ]);
        }
    }
}
