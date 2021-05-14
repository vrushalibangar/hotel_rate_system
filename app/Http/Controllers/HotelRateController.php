<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\HotelRate;
use App\Rules\DateRangeOverlap;
use Illuminate\Http\Request;

class HotelRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_rates = HotelRate::paginate(20);
        return view('backend.hotel_rate.index',compact('hotel_rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::all();
        return view('backend.hotel_rate.manage',compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'hotel_id' => 'required',
            'from_date' => ['required','date',new DateRangeOverlap($request->input('hotel_id'),$request->input('to_date'))],
            'to_date' => ['required','date','after_or_equal:from_date',new DateRangeOverlap($request->input('hotel_id'),$request->input('from_date'))],
            'adult_rate_per_night' => 'required',
            'child_rate_per_night' => 'required'

        ]);

        $hotel_rates = new HotelRate();
        $hotel_rates->from_date = $request->input('from_date');
        $hotel_rates->to_date = $request->input('to_date');
        $hotel_rates->adult_rate_per_night = $request->input('adult_rate_per_night');
        $hotel_rates->child_rate_per_night = $request->input('child_rate_per_night');
        $hotel_rates->hotel_id = $request->input('hotel_id');
        $hotel_rates->note = $request->input('note');
        $hotel_rates->save();

        return redirect(route('hotel_rates.index'))->with('success',__("Hotel Rates added successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HotelRate  $hotelRate
     * @return \Illuminate\Http\Response
     */
    public function show(HotelRate $hotelRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HotelRate  $hotelRate
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelRate $hotel_rate)
    {
        $hotels = Hotel::all();
        return view('backend.hotel_rate.manage',compact(['hotel_rate','hotels']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HotelRate  $hotelRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelRate $hotelRate)
    {
        $request->validate([
            'hotel_id' => 'required',
            'from_date' => ['required','date','after_or_equal:now',new DateRangeOverlap($request->input('hotel_id'),$request->input('to_date'),$hotelRate->id)],
            'to_date' => ['required','date','after_or_equal:from_date',new DateRangeOverlap($request->input('hotel_id'),$request->input('from_date'),$hotelRate->id)],
            'adult_rate_per_night' => 'required',
            'child_rate_per_night' => 'required'
        ]);

        $hotelRate->from_date = $request->input('from_date');
        $hotelRate->to_date = $request->input('to_date');
        $hotelRate->adult_rate_per_night = $request->input('adult_rate_per_night');
        $hotelRate->child_rate_per_night = $request->input('child_rate_per_night');
        $hotelRate->hotel_id = $request->input('hotel_id');
        $hotelRate->note = $request->input('note');
        $hotelRate->save();

        return redirect(route('hotel_rates.index'))->with('success',__("Hotel Rates updated successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HotelRate  $hotelRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelRate $hotelRate)
    {
        $hotelRate->delete();
        return redirect(route('hotel_rates.index'))->with('success',__("Hotel Rate deleted successfully"));
    }
}
