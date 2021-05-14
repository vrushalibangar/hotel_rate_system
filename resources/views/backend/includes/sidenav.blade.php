<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:250px;" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
    <a class="nav-link logo_text" aria-current="page" href="{{ url('/') }}">
        <b>{{ config('app.name', 'Laravel') }}</b>
    </a>
    <a href="{{ url('/admin') }}" class="w3-bar-item w3-button">{{ __('Dashboard')  }}</a>
    <a href="{{ route('hotels.index') }}" class="w3-bar-item w3-button">{{ __('Hotel')  }}</a>
    <a href="{{ route('hotel_rates.index') }}" class="w3-bar-item w3-button">{{ __('Hotel Rates')  }}</a>
</div>

