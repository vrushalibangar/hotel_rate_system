@extends('backend.layout.app')

@section('content')

    <div class="w3-main admin_main_content" style="margin-left:250px">
        <div class="w3-teal">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>{{ __('Hotel Rates') }}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>{{ __('Add Hotel Rate') }}</h3>
            </div>
            <div class="card-body">

                <form class="w3-container" method="post" action="{{ isset($hotel_rate)?route('hotel_rates.update',$hotel_rate):route('hotel_rates.store') }}">
                    @csrf
                    @if(isset($hotel_rate))
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $hotel_rate->id }}">
                    @endif
                    <p>
                        <select name="hotel_id" class="w3-input" >
                            <option></option>
                            @if(!empty($hotels))
                                @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" {{ (isset($hotel_rate) && ($hotel_rate->hotel_id == $hotel->id))?'selected':((old('hotel_id') == $hotel->id)?'selected':'') }}>{{ $hotel->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>{{ __('Hotel') }}</label>
                        <span  class="error"> {{ $errors->first('hotel_id') }}</span>
                    </p>
                    <p>
                        <input name="from_date" class="w3-input" type="date" value="{{ isset($hotel_rate)?$hotel_rate->from_date:old('from_date') }}" min="{{ date('Y-m-d') }}">
                        <label>{{ __('From Date') }}</label>
                        <span class="error"> {{ $errors->first('from_date') }}</span>
                    </p>
                    <p>
                        <input name="to_date" class="w3-input" type="date" value="{{ isset($hotel_rate)?$hotel_rate->to_date:old('to_date') }}" min="{{ date('Y-m-d') }}">
                        <label>{{ __('To Date') }}</label>
                        <span class="error"> {{ $errors->first('to_date') }}</span>
                    </p>
                    <p>
                        <input name="adult_rate_per_night" class="w3-input" type="number" step="0.1" value="{{ isset($hotel_rate)?$hotel_rate->adult_rate_per_night:old('adult_rate_per_night') }}">
                        <label>{{ __('Adult Rate Per Night') }}</label>
                        <span class="error"> {{ $errors->first('adult_rate_per_night') }}</span>
                    </p>
                    <p>
                        <input name="child_rate_per_night" class="w3-input" type="number" step="0.1" value="{{ isset($hotel_rate)?$hotel_rate->child_rate_per_night:old('child_rate_per_night') }}">
                        <label>{{ __('Child Rate Per Night') }}</label>
                        <span class="error"> {{ $errors->first('child_rate_per_night') }}</span>
                    </p>
                    <p>
                        <textarea name="note" rows="1" class="w3-input" >{{ isset($hotel_rate)?$hotel_rate->note:old('note') }}</textarea>
                        <label>{{ __('Note') }}</label>
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