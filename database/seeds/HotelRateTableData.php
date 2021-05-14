<?php

use App\HotelRate;
use Illuminate\Database\Seeder;

class HotelRateTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        HotelRate::create([
            'hotel_id' => '1',
            'from_date' => '2021-05-15',
            'to_date' => '2021-05-31',
            'adult_rate_per_night' => 30,
            'child_rate_per_night' => 10,
            'note' => '',
        ]);
        HotelRate::create([
            'hotel_id' => '1',
            'from_date' => '2021-06-01',
            'to_date' => '2021-06-15',
            'adult_rate_per_night' => 35,
            'child_rate_per_night' => 15,
            'note' => '',
        ]);
        HotelRate::create([
            'hotel_id' => '1',
            'from_date' => '2021-06-16',
            'to_date' => '2021-06-30',
            'adult_rate_per_night' => 45,
            'child_rate_per_night' => 25,
            'note' => '',
        ]);
    }
}
