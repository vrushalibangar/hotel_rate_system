<?php

namespace App\Rules;

use App\HotelRate;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DateRangeOverlap implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hotel_id, $another_date, $hotel_rate_id = '')
    {
        $this->hotel_id = $hotel_id;
        $this->another_date = $another_date;
        $this->hotel_rate_id = $hotel_rate_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($attribute == 'from_date'){
            $start_date = $value;
            $end_date = $this->another_date;
        }else{
            $end_date = $value;
            $start_date = $this->another_date;
        }
        $hotel_rate = HotelRate::where('hotel_id',$this->hotel_id)
            ->where(function ($query) use ($attribute,$start_date,$end_date) {
            $query->whereBetween($attribute, [$start_date, $end_date])
                ->orWhere(DB::raw("'".$start_date."' <= from_date and '".$end_date."' >= to_date"))
                ->orWhereRaw("(('".$start_date."' BETWEEN from_date AND to_date) OR ('".$end_date."' BETWEEN from_date AND to_date))");
        });
        if($this->hotel_rate_id != ''){
            $hotel_rate->where('id','<>',$this->hotel_rate_id);
        }
        $hotel_rate = $hotel_rate->get();
        if(count($hotel_rate) == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please select other date range.';
    }
}
