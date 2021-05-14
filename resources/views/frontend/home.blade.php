@extends('frontend.layout.app')

@section('content')

    <!-- Background image -->
    <div
            class="p-5 text-center bg-image"
            style="
                    background-image: url('{{ asset('public/assets/img/hotel.jpg') }}');
                    height: 530px;
                    "
    >
        <div class="mask" style="background-color: rgb(0 0 0 / 21%);">
            <div class="d-flex  align-items-center h-100" style="margin-left: 150px;">
                <div class="text-white rate_form_box">
                    <form method="post" action="{{ route('calculate_rate') }}">
                        @csrf
                        <div>
                            <div class="form-group">
                                <label>{{ __('Hotel') }} <span class="error">{{ $errors->first('hotel_id') }}</span></label>
                                <span>
                                <select name="hotel_id" class="form-control">
                                    <option></option>
                                    @if(!empty($hotels))
                                        @foreach($hotels as $hotel)
                                            <option value="{{ $hotel->id }}" {{ (old('hotel_id') == $hotel->id)?'selected':'' }}>{{ $hotel->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </span>

                            </div>
                            <div class="form-group">
                                <label>{{ __('Check in date') }} <span class="error">{{ $errors->first('check_in_date') }}</span></label>
                                <span>
                                <input name="check_in_date" class="form-control" type="date" value="{{ old('check_in_date') }}" min="{{ date('Y-m-d') }}">
                            </span>

                            </div>
                            <div class="form-group">
                                <label>{{ __('Checkout date') }} <span class="error">{{ $errors->first('check_out_date') }}</span></label>
                                <span>
                                <input name="check_out_date" class="form-control" type="date" value="{{ old('check_out_date') }}" min="{{ date('Y-m-d') }}">
                            </span>

                            </div>
                            <div class="form-group">
                                <label>{{ __('No of adults') }} <span class="error">{{ $errors->first('no_of_adults') }}</span></label>
                                <span>
                                <input type="number" class="form-control" name="no_of_adults" value="{{ old('no_of_adults') }}">
                            </span>

                            </div>
                            <div class="form-group">
                                <label>{{ __('No of children') }} <span class="error">{{ $errors->first('no_of_child') }}</span></label>
                                <span>
                                <input type="number" class="form-control" name="no_of_child" value="{{ old('no_of_child') }}">
                            </span>

                            </div>
                            <div class="form-group">
                                <label></label>
                                <span>
                                <button class="btn blue_shade form-control" type="submit">{{ __('Submit') }}</button>
                            </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success') || session('error'))
        <div class="" style="background-color: rgb(0 0 0 / 21%);">
            <div class="d-flex pull-right  align-items-center h-100" style="float: right;margin-left: 150px;position: absolute;right: 200px;">
                <div class="text-white rate_form_box">
                    @if(session('error'))
                        <h3 class="error">{{ session('error') }}</h3>
                    @endif
                    @if(session('success'))
                        <h4>{{ __('Total Fare') }}</h4>
                        <h5>{{ __('Per Adult Rate') }} : ${{ @session('per_adult_rate') }}</h5>
                        <h5>{{ __('Per Child Rate') }} : ${{ @session('per_child_rate') }}</h5>
                        <h5>{{ __('Total') }} : ${{ @session('total') }} [( ${{ @session('per_adult_rate') }} x {{ @session('no_of_adults') }} ) + ( ${{ @session('per_child_rate') }} x {{ @session('no_of_child') }} )]</h5>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- Background image -->
    <div class="container page_content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                </div>
            </div>
        </div>
    </div>
@endsection
