<?php

namespace App;

use App\HotelRate;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{

    public function hotel_rates(){
        return $this->hasMany(HotelRate::class);
    }


    public static function get_stars_dropdown(){
        $stars_dropdown = [
            '3' => '3 Star',
            '4' => '4 Star',
            '5' => '5 Star',
            '7' => '7 Star'
            ];
        return $stars_dropdown;
    }
}
