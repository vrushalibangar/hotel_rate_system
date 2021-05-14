<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->delete();

        Hotel::create([
            'name' => 'Orchid',
            'hotel_stars' => 4,
            'hotel_address' => 'Near Kalyan Railway Station, Kalyan 421301'
        ]);
        Hotel::Create([
            'name' => 'Rockford Resort',
            'hotel_stars' => 5,
            'hotel_address' => 'Mahabaleshwar'
        ]);
    }
}
