<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenseds = [
            'السعودية',
            'الإماراتية',
            'القطرية',
            'العمانية',
            'الكويتية',
            'جنسية البحرين'
        ];

        foreach ($licenseds as $licensed) {
            DB::table('nationalities')->insert([
                'name' => $licensed,
                'created_at' => now(),
            ]);
        }
    }
}
