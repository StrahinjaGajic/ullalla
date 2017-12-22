<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('partials._header')
</head>
<body>
	@if (in_array(Route::getCurrentRoute()->uri(), getNavUris()))
		@include('partials._home_nav')
	@else
		@include('partials._nav')
	@endif
	@yield('content')
	@include('partials._footer')
</body>
</html>