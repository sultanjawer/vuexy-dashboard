<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directions = [
            'شمال',
            'جنوب',
            'غرب',
            'شرق',
        ];

        foreach ($directions as $direction) {
            DB::table('directions')->insert([
                'name' => $direction,
                'created_at' => now(),
            ]);
        }
    }
}
