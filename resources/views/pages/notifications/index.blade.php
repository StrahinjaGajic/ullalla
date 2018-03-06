@extends('layouts.app')

@section('title', __('headings.packages'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container">
	<ul>
		@foreach($user->notifications as $notification)
		<li>{{ $notification->title . ' - ' . $notification->note }}</li>
		@endforeach
	</ul>	
</div>
@stop