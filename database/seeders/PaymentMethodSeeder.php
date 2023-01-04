<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_methods = [
            'نقدا',
            'شيك',
            'حوالة بنكية'
        ];

        foreach ($payment_methods as $payment_method) {
            DB::table('payment_methods')->insert([
                'name' => $payment_method,
                'created_at' => now()
            ]);
        }
    }
}
