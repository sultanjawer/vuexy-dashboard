<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StreetWidthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $streets = [
            "عرض الشارع الاول" => '15',
            'عرض الشارع الثاني' => '30',
            'عرض الشارع الثالث' => '50',

        ];

        foreach ($streets as $index => $street) {
            DB::table('street_widths')->insert([
                'name' => $index,
                'street_number' => $street,
                'created_at' => now(),
            ]);
        }
    }
}
