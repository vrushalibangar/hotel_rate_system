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
                <h3>{{ __('Hotels List') }}</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="w3-panel w3-pale-green w3-border">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <a href="{{ route('hotels.create') }}" class="btn add_btn" >{{ __('Add Hotel') }}</a>
                <table class="w3-table-all">
                    <thead>
                    <tr class="blue_shade">
                        <th>{{ __('Hotel Name') }}</th>
                        <th>{{ __('Number Of Stars') }}</th>
                        <th>{{ __('Hotel Address') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($hotels) > 0)
                        @foreach ($hotels as $hotel)
                            <tr>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->hotel_stars }}</td>
                                <td>{{ $hotel->hotel_address }}</td>
                                <td>
                                    <a href="{{ route('hotels.edit',$hotel) }}" class="btn btn-sm btn-primary" >{{ __('Edit') }}</a>
                                    <form class="form-inline-block" method="post" action="{{ route('hotels.destroy',$hotel) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="Delete">
                                        <button type="submit" onclick="return confirm('{{ __('Are you sure want to delete') }}');" class="btn btn-sm btn-danger" >{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4">{{ __('No Data Available') }}</td></tr>
                    @endif
                    </tbody>
                </table>
                {{ $hotels->links() }}
            </div>

        </div>
    </div>

    </div>

@endsection