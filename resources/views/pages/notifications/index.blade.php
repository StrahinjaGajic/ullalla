@extends('layouts.app')

@section('title', 'Packages')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
<div class="shop-header-banner">
	<span><img src="img/banner/profil-banner.jpg" alt=""></span>
</div>
<div class="container">
	<ul>
		@foreach($user->notifications as $notification)
		<li>{{ $notification->title . ' - ' . $notification->note }}</li>
		@endforeach
	</ul>	
</div>
@stop