<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hotel;

class HotelRate extends Model
{
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}
