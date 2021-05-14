<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableDataSeeder::class);
        $this->command->info('User table seeded!');
        $this->call(HotelTableDataSeeder::class);
        $this->command->info('Hotel table seeded!');
        $this->call(HotelRateTableData::class);
        $this->command->info('HotelRates table seeded!');
    }
}
