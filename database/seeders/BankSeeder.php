<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'AAAL' => 'البنك السعودي الهولندي',
            'ALBI' => 'بنك البلاد',
            'ARNB' => 'البنك العربي الوطني',
            'BJAZ' => 'بنك الجزيرة',
            'BSFR' => 'البنك السعودي الفرنسي',
            'NCBK' => 'البنك الأهلي',
            'RIBL' => 'بنك الرياض',
            'RJHI' => 'بنك الراجحي',
            'SABB' => 'البنك السعودي البريطاني',
            'SIBC' => 'البنك السعودي للإستثمار',
        ];

        foreach ($banks as $swift_code => $name) {
            DB::table('banks')->insert([
                'name' => $name,
                'swift_code' => $swift_code,
                'created_at' => now(),
            ]);
        }
    }
}
