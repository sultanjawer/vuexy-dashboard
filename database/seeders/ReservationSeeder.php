<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {

            $offer_id = random_int(1, 400);
            $offer_status = random_int(1, 2);
            $offer = Offer::find($offer_id);
            $acive_reservation = $offer->reservations->where('statu', 1)->first();
            if (!$acive_reservation) {
                DB::table('reservations')->insert([
                    'user_id' => 1,
                    'customer_name' => 'proamrakram',
                    'customer_id' => $customer->id,
                    'offer_id' => $offer_id,
                    'offer_code' => 'QTE',
                    'price' => 1000,
                    'status' => $offer_status,
                    'note' => Str::random(16),
                    'date_from' => now(),
                    'date_to' => now()->addDays(10),
                    'created_at' => now()->addDays(random_int(1, 100))
                ]);

                $real_estate = $offer->realEstate;
                $real_estate->update(['property_status_id' => 2]);
            }
        }
    }
}
