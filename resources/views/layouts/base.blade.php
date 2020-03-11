<!doctype html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.45.0/maps/maps.css'>
		<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.45.0/maps/maps-web.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/it.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
	<body>
		@yield('guest_index')
		@yield('search')
		@yield('user-panel')
		@yield('login')
		@yield('register')
		@yield('create')
		@yield('update')
		@yield('apt-show')
        @yield('new-apt-upa')
        @yield('hosted')
        @yield('charts')
	</body>
</html>
