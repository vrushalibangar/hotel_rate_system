<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::paginate(20);
        return view('backend.hotel.index',compact(['hotels']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stars_dropdown = Hotel::get_stars_dropdown();
        return view('backend.hotel.manage',compact(['stars_dropdown']));
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
            'name' => 'required',
            'hotel_stars' => 'required|numeric'
        ]);

        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->hotel_stars = $request->input('hotel_stars');
        $hotel->hotel_address = $request->input('hotel_address');
        $hotel->save();

        return redirect(route('hotels.index'))->with('success',__("Hotel added successfully"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $stars_dropdown = Hotel::get_stars_dropdown();
        return view('backend.hotel.manage',compact(['stars_dropdown','hotel']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'hotel_stars' => 'required|numeric'
        ]);

        $hotel->name = $request->input('name');
        $hotel->hotel_stars = $request->input('hotel_stars');
        $hotel->hotel_address = $request->input('hotel_address');
        $hotel->save();

        return redirect(route('hotels.index'))->with('success',__("Hotel updated successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect(route('hotels.index'))->with('success',__("Hotel deleted successfully"));
    }
}
