@extends('layouts.app')

@section('title', 'Private')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/girls.css') }}">
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.18/plyr.css">
@stop

@section('content')
<div class="wrapper section-single-girl">
	<div class="shop-header-banner">
		<span><img src="{{ url('img/banner/profil-banner.jpg') }}" alt=""></span>
	</div>
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>Profile</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="product-essential">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
					<div class="zoomWrapper">
						<div id="img-1" class="zoomWrapper single-zoom">
							<a>
								<img id="expand" src="{{ $user->photos . 'nth/0/-/resize/490x560/' }}" data-zoom-image="{{ $user->photos . 'nth/2/-/resize/1044x1200/' }}" alt="">
								<div id="myModal" class="modal">
									<span class="close">&times;</span>
									<img class="modal-content" id="img01">
									<div id="caption"></div>
								</div>
							</a>
						</div>
						<div class="single-zoom-thumb">
							<ul class="bxslider" id="gallery_01">
								@for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
								<li>
									<a href="single-product.html#" class="elevatezoom-gallery active" data-update="" data-image="{{ $user->photos . 'nth/' . $i . '/-/resize/490x560/' }}" data-zoom-image="{{ $user->photos . 'nth/' . $i . '/-/resize/1044x1200/' }}"><img src="{{ $user->photos . 'nth/' . $i . '/-/resize/127x145/' }}" alt="zo-th-1" /></a>
								</li>
								@endfor
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<div class="product-details shop-review single-pro-zoom">
						<div class="product-name">
							<h3><a>{{ $user->nickname }}</a></h3>
						</div>
						<div class="product-reveiw">
							<p>{{ Str::words($user->about_me, 40) }}</p>
						</div>
						<table class="info-table">{{ parseSingleUserData(getBioFields(), $user) }}</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-product-description">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="product-description-tab custom-tab">
						<ul class="nav nav-tabs" role="tablist">
							@if($user->videos)
							<li><a href="#girl-videos" data-toggle="tab">Videos</a></li>
							@endif
							@if ($user->about_me)
							<li><a href="#girl-description" data-toggle="tab">About Me</a></li>
							@endif
							@if($user->services->count())
							<li><a href="#girl-services" data-toggle="tab">Services</a></li>
							@endif
							@if($user->hasContact())
							<li><a href="#girl-contact" data-toggle="tab">Contact</a></li>
							@endif
							@if($user->prices()->count())
							<li><a href="#girl-prices" data-toggle="tab">Prices</a></li>
							@endif
							@if($user->hasWorkplace())
							<li><a href="#girl-workplace" data-toggle="tab">Workplace</a></li>
							@endif
							@if($user->working_time)
							<li><a href="#girl-workinghours" data-toggle="tab">Work Time</a></li>
							@endif
							@if($user->spoken_languages()->count())
							<li><a href="#girl-languages" data-toggle="tab">Languages</a></li>
							@endif
							@if($user->city)
							<li><a href="#girl-map" data-toggle="tab">Map</a></li>
							@endif
						</ul>
						<div class="tab-content">
							@if($user->videos)
							<div class="tab-pane" id="girl-videos">
								<video poster="/path/to/poster.jpg" controls>
									<source src="{{ $user->videos }}" type="video/mp4">
									</video>
								</div>
								@endif
								@if ($user->about_me)
								<div class="tab-pane" id="girl-description">
									<p>{{ $user->about_me }}</p>
								</div>
								@endif
								@if($user->services()->count())
								<div class="tab-pane" id="girl-services">
									@if($user->service_options()->count())
									<h4><strong>I Offer Services For: </strong></h4>
									<h5>{{ getDataAndCutLastCharacter($user->service_options, 'service_option_name') }}</h5>
									@endif
									<table class="table services-table">{{ parseChunkedServices($user) }}</table>
								</div>
								@endif
								@if($user->hasContact())
								<div class="tab-pane" id="girl-contact">
									<table class="table">{{ parseSingleContactData(getContactFields(), $user) }}</table>
								</div>
								@endif
								@if($user->prices()->count())
								<div class="tab-pane" id="girl-prices">
									<table class="table">
										<thead>
											<tr>
												<th>Type</th>
												<th>Duration</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody id="prices_body">
											@foreach ($user->prices->sortBy('price_type') as $price)
											<tr>
												<td>{{ ucfirst($price->price_type) }}</td>
												<td>{{ $price->service_duration . ' ' . $price->service_price_unit }}</td>
												<td>{{ $price->service_price . ' ' . strtoupper($price->service_price_currency) }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@endif
								@if($user->hasWorkplace())
								<div class="tab-pane" id="girl-workplace">
									<table class="table">{{ parseWorkplaceDate(getWorkplaceFields(), $user) }}</table>
								</div>
								@endif
								@if($user->working_time)
								<div class="tab-pane" id="girl-workinghours">
									@if(isJson($user->working_time))
									<table class="table working-times-table">
										<thead>
											<tr>
												<th>Day</th>
												<th>From</th>
												<th>To</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php $workingTimes = json_decode($user->working_time); ?>
											@foreach($workingTimes as $workingTime)
											<tr>
												<td>{{ explode('|', $workingTime)[0] }}</td>
												<td>{{ explode(' - ', explode('|', $workingTime)[1])[0] }}</td>
												<td>{{ explode('&', explode(' - ', explode('|', $workingTime)[1])[1])[0] }}</td>
												<td>{{ isset(explode('&', explode(' - ', explode('|', $workingTime)[1])[1])[1]) ? 'Night Escort' : '' }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@else
									@php
									$workingTime = explode('&', $user->working_time);
									@endphp
									<h3>{{ $workingTime[0] }} <span>{{ isset($workingTime[1]) ? $workingTime[1] : '' }}</span></h3>
									@endif
								</div>
								@endif
								@if($user->spoken_languages()->count())
								<div class="tab-pane" id="girl-languages">
									<table class="table">
										<thead>
											<tr>
												<th>Language</th>
												<th>Level</th>
											</tr>
										</thead>
										<tbody>
											@foreach($user->spoken_languages as $spokenLanguage)
											<tr>
												<td>{{ $spokenLanguage->spoken_language_name }}</td>
												<td>
													@for($level = 1; $level <= 5; $level++)
													@if($level <= $spokenLanguage->pivot->language_level)
													<i class="fa fa-flag" aria-hidden="true"></i>
													@else
													<i class="fa fa-flag" aria-hidden="true" style="color: #ddd"></i>
													@endif
													@endfor
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@endif
								<div class="tab-pane" id="girl-map">
									<div id="map" style="width: 600px; height: 600px;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-area-2 home-4">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="single-banner">
							<a class="last-banner" href="index.html">
								<span>
									<img src="{{ asset('img/banner/fullwide-banner-4.jpg') }}" alt="">
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>

	@php
	if ($user->city) {
		$userAddress = $user->city;
		if ($user->address) {
			$userAddress = $user->address . ',' . $user->city;
		}
	}
	@endphp

	@stop

	@section('perPageScripts')
	<script src="https://cdn.plyr.io/2.0.18/plyr.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4"></script>
	<!-- Call Plyr -->
	<script>
		plyr.setup({
			speeds: [0.5, 1.0, 1.5, 2.0, 2.5],
		});
	</script>

	@if(isset($userAddress))
	<script>

		$('a[href="#girl-map"]').on('click', function () {
			setTimeout(initMap, 10);	
		});

		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 16,
				center: {lat: -34.397, lng: 150.644}
			});
			var geocoder = new google.maps.Geocoder();
			geocodeAddress(geocoder, map);
		}

		function geocodeAddress(geocoder, resultsMap) {
			var address = '{{ $userAddress }}';
			geocoder.geocode({'address': address}, function(results, status) {
				if (status === 'OK') {
					resultsMap.setCenter(results[0].geometry.location);
					console.log(results);
					var marker = new google.maps.Marker({
						map: resultsMap,
						position: results[0].geometry.location
					});
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}
			});
		}
	</script>
	@endif


	<script>
		$(function () {
			$('.nav-tabs').find('li:first-child').addClass('active');
			$('.tab-content').find('.tab-pane:first-child').addClass('active');
		});
	</script>


	<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('expand');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
	modal.style.display = "block";
	modalImg.src = this.src;
	captionText.innerHTML = this.alt;
	$('body').css('overflow','hidden');
	$('body').css('position','fixed');
	$('body').css('overflow','auto');

}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
	modal.style.display = "none";
}
</script>



@stop