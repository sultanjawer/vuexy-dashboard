<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\RealEstate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer_counts = 1;

        $real_estates = RealEstate::all();

        foreach ($real_estates as $real_estate) {

            $branch = Branch::find($real_estate->branch_id);

            $offer_code = ucwords($branch->code) . '-' . $offer_counts . '-USR1';

            $offer_type_id = random_int(1, 2);
            if ($offer_type_id == 1) {
                DB::table('offers')->insert([
                    'offer_code' => $offer_code,
                    'real_estate_id' => $real_estate->id,
                    'offer_type_id' => random_int(1, 2),
                    'user_id' => 1,
                    'who_add' => 1,
                    'who_edit' => null,
                    'who_cancel' => null,
                    // 'mediators_ids' => json_encode([]),
                    'booking_ids' => json_encode([]),
                    'created_at' => now()
                ]);
            }

            if ($offer_type_id == 2) {
                DB::table('offers')->insert([
                    'offer_code' => $offer_code,
                    'real_estate_id' => $real_estate->id,
                    'offer_type_id' => random_int(1, 2),
                    'user_id' => 1,
                    'who_add' => 1,
                    'who_edit' => null,
                    'who_cancel' => null,
                    // 'mediators_ids' => json_encode([101, 102, 103, 104, 105]),
                    'booking_ids' => json_encode([]),
                    'created_at' => now()
                ]);
            }

            $offer_counts = $offer_counts + 1;
        }
    }
}
