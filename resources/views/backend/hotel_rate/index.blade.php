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
                <h3>{{ __('Hotel Rates List') }}</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="w3-panel w3-pale-green w3-border">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <a href="{{ route('hotel_rates.create') }}" class="btn add_btn" >{{ __('Add Hotel Rate') }}</a>
                <table class="w3-table-all">
                    <thead>
                    <tr class="blue_shade">
                        <th>{{ __('From Date') }}</th>
                        <th>{{ __('Hotel') }}</th>
                        <th>{{ __('Rate for Adult per night [ USD ] ') }}</th>
                        <th>{{ __('Rate for child per night [ USD ]') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($hotel_rates) > 0)
                        @foreach ($hotel_rates as $rate)
                            <tr>
                                <td>{{ date('d-M-Y',strtotime($rate->from_date)).' '.__('To').' '.date('d-M-Y',strtotime($rate->to_date)) }}  </td>
                                <td>{{ $rate->hotel->name }}</td>
                                <td>{{ $rate->adult_rate_per_night }}</td>
                                <td>{{ $rate->child_rate_per_night }}</td>
                                <td>
                                    <a href="{{ route('hotel_rates.edit',$rate) }}" class="btn btn-sm btn-primary" >{{ __('Edit') }}</a>
                                    <form class="form-inline-block" method="post" action="{{ route('hotel_rates.destroy',$rate) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="Delete">
                                        <button type="submit" onclick="return confirm('{{ __('Are you sure want to delete') }}');" class="btn btn-sm btn-danger" >{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">{{ __('No Data Available') }}</td></tr>
                    @endif
                    </tbody>
                </table>
                {{ $hotel_rates->links() }}
            </div>

        </div>
    </div>

    </div>

@endsection