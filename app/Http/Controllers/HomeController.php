<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\HotelRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('frontend.home',compact('hotels'));
    }

    public function calculate_rate(Request $request){
        $request->validate([
            'hotel_id' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'no_of_adults' => 'required',
            'no_of_child' => 'required',
        ]);

        $check_in_date = $request->input('check_in_date');
        $check_out_date = $request->input('check_out_date');
        $no_of_adults = $request->input('no_of_adults');
        $no_of_child = $request->input('no_of_child');
        $hotel_id = $request->input('hotel_id');

        $hotel_rates = HotelRate::where(function ($query) use ($check_in_date,$check_out_date){
            $query->orWhereBetween('from_date', [$check_in_date, $check_out_date])
            ->orWhereBetween('to_date', [$check_in_date, $check_out_date])
            ->orWhereRaw("(('".$check_in_date."' BETWEEN from_date AND to_date) OR ('".$check_out_date."' BETWEEN from_date AND to_date))");

        })
        //whereRaw("((from_date BETWEEN '".$check_in_date."' AND '".$check_out_date."') OR (to_date BETWEEN '".$check_in_date."' AND '".$check_out_date."'))")
            ->where('hotel_id',$hotel_id)
            ->orderBy('from_date','asc')
            ->orderBy('to_date','asc')
            ->select('*',DB::raw('DATEDIFF( to_date,from_date ) total_days'))
            ->get();


        if(!empty($hotel_rates)){
            $min_date = $hotel_rates->min('from_date');
            $max_date = $hotel_rates->max('to_date');

            if((strtotime($min_date) > strtotime($check_in_date)) || (strtotime($max_date) < strtotime($check_out_date))){
                return redirect(route('home'))->with('error','Some dates are not available, Please select other dates')->withInput();
            }

            $end_date = '';
            foreach ($hotel_rates as $rate){
                if($end_date != ''){
                    $expected_start_date = date('Y-m-d', strtotime($end_date. ' + 1 days'));
                    if($expected_start_date != $rate->from_date){
                        return redirect(route('home'))->with('error','Some dates are not available, Please select other dates')->withInput();
                    }
                    $end_date = $rate->to_date;
                }else{
                    $end_date = $rate->to_date;
                }
            }
        }else{
            return redirect(route('home'))->with('error','These dates are not available, Please select other dates')->withInput();
        }

        $per_adult_rate = 0;
        $per_child_rate = 0;




        if(count($hotel_rates) > 1){
            $first_record = $hotel_rates->first();
            $check_in_date_time = new DateTime($check_in_date);
            $first_record_end_date_time = new DateTime($first_record->to_date);
            $first_record_no_of_days = ($first_record_end_date_time->diff($check_in_date_time))->format('%a');
            $per_adult_rate += ($first_record_no_of_days*$first_record->adult_rate_per_night);
            $per_child_rate += ($first_record_no_of_days*$first_record->child_rate_per_night);

            $last_record = $hotel_rates->last();
            $check_out_date_time = new DateTime($check_out_date);
            $last_record_from_date_time = new DateTime($last_record->from_date);
            $last_record_no_of_days = ($check_out_date_time->diff($last_record_from_date_time))->format('%a');
            $per_adult_rate += ($last_record_no_of_days*$last_record->adult_rate_per_night);
            $per_child_rate += ($last_record_no_of_days*$last_record->child_rate_per_night);
            $hotel_rates->shift();
            $hotel_rates->pop();
            if(!empty($hotel_rates)){
                foreach ($hotel_rates as $rate){
                    $per_adult_rate += ($rate->total_days *$rate->adult_rate_per_night);
                    $per_child_rate += ($rate->total_days *$rate->child_rate_per_night);
                }
            }
        }else{
            $first_record = $hotel_rates->first();
            $check_in_date_time = new DateTime($check_in_date);
            $check_out_date_time = new DateTime($check_out_date);
            $no_of_days = ($check_out_date_time->diff($check_in_date_time))->format('%a');
            $per_adult_rate += ($no_of_days*$first_record->adult_rate_per_night);
            $per_child_rate += ($no_of_days*$first_record->child_rate_per_night);
        }

        $total = ($per_adult_rate*$no_of_adults)+($per_child_rate*$no_of_child);
        return redirect(route('home'))->with(['success'=>1,'per_adult_rate'=>$per_adult_rate,'per_child_rate'=>$per_child_rate,'total'=>$total,'no_of_adults'=>$no_of_adults,'no_of_child'=>$no_of_child])->withInput();

    }
}
