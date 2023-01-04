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
            "عرض الشارع الاول" => '6',
            "عرض الشارع الاول" => '8',
            'عرض الشارع الثاني' => '15',
            'عرض الشارع الرابع' => '18',
            'عرض الشارع الخامس' => '20',
            'عرض الشارع السادس' => '25',
            'عرض الشارع السابع' => '30',
            'عرض الشارع الثامن' => '40',
            'عرض الشارع التاسع' => '60',
            'عرض الشارع العاشر' => '100',
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
