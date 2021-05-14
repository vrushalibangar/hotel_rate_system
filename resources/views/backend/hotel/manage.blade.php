@extends('backend.layout.app')

@section('content')

    <div class="w3-main admin_main_content" style="margin-left:250px">
        <div class="w3-teal">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>{{ __('Hotels') }}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>{{ __('Add Hotel') }}</h3>
            </div>
            <div class="card-body">

                <form class="w3-container" method="post" action="{{ isset($hotel)?route('hotels.update',$hotel):route('hotels.store') }}">
                    @csrf
                    @if(isset($hotel))
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $hotel->id }}">
                    @endif
                    <p>
                        <input name="name" class="w3-input" type="text" value="{{ isset($hotel)?$hotel->name:old('name') }}">
                        <label>{{ __('Hotel Name') }}</label>
                        <span class="error"> {{ $errors->first('name') }}</span>

                    </p>
                    <p>
                        <select name="hotel_stars" class="w3-input" >
                            <option></option>
                            @if(!empty($stars_dropdown))
                                @foreach($stars_dropdown as $key => $value)
                                    <option value="{{ $key }}" {{ (isset($hotel) && $hotel->hotel_stars == $key)?'selected':((old('hotel_stars') == $key)?'selected':'') }}>{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>{{ __('Hotel Stars') }}</label>
                        <span  class="error"> {{ $errors->first('hotel_stars') }}</span>
                    </p>
                    <p>
                        <textarea name="hotel_address" rows="1" class="w3-input" >{{ isset($hotel)?$hotel->hotel_address:old('hotel_address') }}</textarea>
                        <label>{{ __('Hotel Address') }}</label>
                    </p>
                    <p>
                        <button type="submit" class="w3-button w3-teal">{{ __('submit') }}</button>
                    </p>
                </form>
            </div>

        </div>
    </div>

    </div>

@endsection