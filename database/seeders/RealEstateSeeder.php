<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\BuildingStatus;
use App\Models\BuildingType;
use App\Models\City;
use App\Models\ConstructionDelivery;
use App\Models\Direction;
use App\Models\InterfaceLength;
use App\Models\LandType;
use App\Models\Licensed;
use App\Models\Neighborhood;
use App\Models\OwnerShipType;
use App\Models\PropertyStatus;
use App\Models\StreetWidth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_city_id = City::all()->pluck('id')->max();
        $min_city_id = City::all()->pluck('id')->min();
        $max_neighborhood_id = Neighborhood::all()->pluck('id')->max();
        $min_neighborhood_id = Neighborhood::all()->pluck('id')->min();
        $max_street_width_id = StreetWidth::all()->pluck('id')->max();
        $min_street_width_id = StreetWidth::all()->pluck('id')->min();
        $max_direction_id = Direction::all()->pluck('id')->max();
        $min_direction_id = Direction::all()->pluck('id')->min();
        $max_land_type_id = LandType::all()->pluck('id')->max();
        $min_land_type_id = LandType::all()->pluck('id')->min();
        $max_branch_id = Branch::all()->pluck('id')->max();
        $min_branch_id = Branch::all()->pluck('id')->min();

        $max_property_status_id = PropertyStatus::all()->pluck('id')->max();
        $min_property_status_id = PropertyStatus::all()->pluck('id')->min();

        $max_interface_length_id = InterfaceLength::all()->pluck('id')->max();
        $min_interface_length_id = InterfaceLength::all()->pluck('id')->min();

        $max_licensed_id = Licensed::all()->pluck('id')->max();
        $min_licensed_id = Licensed::all()->pluck('id')->min();

        $max_owner_ship_type_id = OwnerShipType::all()->pluck('id')->max();
        $min_owner_ship_type_id = OwnerShipType::all()->pluck('id')->min();

        $max_building_type_id = BuildingType::all()->pluck('id')->max();
        $min_building_type_id = BuildingType::all()->pluck('id')->min();

        $max_building_status_id = BuildingStatus::all()->pluck('id')->max();
        $min_building_status_id = BuildingStatus::all()->pluck('id')->min();

        $max_construction_delivery_id = ConstructionDelivery::all()->pluck('id')->max();
        $min_construction_delivery_id = ConstructionDelivery::all()->pluck('id')->min();


        $count = 0;

        $property_types = [
            1 => 'land',
            2 => 'duplex',
            3 => 'condominium',
            4 => 'flat',
            5 => 'chalet'
        ];

        while ($count < 500) {
            $property_type_id = random_int(1, 5);

            DB::table('real_estates')->insert([
                'city_id' => random_int($min_city_id, $max_city_id),
                'neighborhood_id' => random_int($min_neighborhood_id, $max_neighborhood_id),
                // 'street_width_id' => random_int($min_street_width_id, $max_street_width_id),
                // 'direction_id' => random_int($min_direction_id, $max_direction_id),
                'land_type_id' => random_int($min_land_type_id, $max_land_type_id),
                'property_type_id' => $property_type_id,
                'property_status_id' => 1,
                'interface_length_id' => random_int($min_interface_length_id, $max_interface_length_id),
                'licensed_id' => random_int($min_licensed_id, $max_licensed_id),
                'owner_ship_type_id' => random_int($min_owner_ship_type_id, $max_owner_ship_type_id),
                'building_type_id' => random_int($min_building_type_id, $max_building_type_id),
                'building_status_id' => random_int($min_building_status_id, $max_building_status_id),
                'construction_delivery_id' => random_int($min_construction_delivery_id, $max_construction_delivery_id),
                'real_estate_age' => random_int(10, 50),
                'floor_number' => random_int(10, 100),
                'floors_number' => random_int(10, 100),
                'flats_numbers' => random_int(10, 100),
                'flat_rooms_number' => random_int(10, 100),
                'rooms_number' => random_int(10, 100),
                'stores_number' => random_int(10, 100),
                'price_by_meter' => random_int(10, 100),
                // 'price' => random_int(10, 100),
                'total_price' => random_int(10, 100),
                'annual_income' => random_int(10, 100),
                'space' => random_int(10, 100),
                'notes' => Str::random(10),
                'real_estate_statement' => Str::random(10),
                'land_number' => random_int(1111111, 9999999),
                'block_number' => random_int(1111111, 9999999),
                'branch_id' => random_int($min_branch_id, $max_branch_id),
                'character' => Str::random(10),
                'real_estate_type' => $property_types[$property_type_id],
                'created_at' => now(),
            ]);

            $count = $count + 1;
        }
    }
}
