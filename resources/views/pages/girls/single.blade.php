@extends('layouts.app')

@section('title', 'Private')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/girls.css') }}">
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.18/plyr.css">
@stop

@section('content')
<div class="wrapper section-single-girl">
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="{{ url('/') }}">{{ __('buttons.home') }}</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>{{ __('buttons.profile') }}</li>
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
							<a href="#">
								<img id="is_image_large" class="expand" src="{{ $user->photos . 'nth/0/-/resize/490x560/' }}" alt="">
								<div id="myModal" class="modal">
								<span class="close">&times;</span>
								<div class="modal-dialog modal-md">
									
									<div class="modal-content">
									<img id="img01" src="{{ $user->photos . 'nth/0/-/resize/490x560/' }}">
                                   <div class="prev-next">    
                                    <a type="button" onclick="prev()" id="prev" class="glyphicon glyphicon-chevron-left"></a>
                                    <a type="button" onclick="next()" id="next" class="glyphicon glyphicon-chevron-right" style="float:right;"></a>
                                        </div>
                                      </div>
                                      </div>      
								</div>
							</a>
						</div>
						<div class="single-zoom-thumb">
							<ul class="bxslider" id="gallery_01">
								@for ($i = 0; $i < substr($user->photos, -2, 1); $i++)
								<li>
									<a href="#" class="active" data-update="">
										<img src="{{ $user->photos . 'nth/' . $i . '/-/resize/127x145/' }}" alt="zo-th-1" />
									</a>
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
							<li><a href="#girl-videos" data-toggle="tab">{{ __('headings.videos') }}</a></li>
							@endif
							@if ($user->about_me)
							<li><a href="#girl-description" data-toggle="tab">{{ __('headings.about_me') }}</a></li>
							@endif
							@if($user->services->count())
							<li><a href="#girl-services" data-toggle="tab">{{ __('headings.services') }}</a></li>
							@endif
							@if($user->hasContact())
							<li><a href="#girl-contact" data-toggle="tab">{{ __('headings.contact') }}</a></li>
							@endif
							@if($user->prices()->count())
							<li><a href="#girl-prices" data-toggle="tab">{{ __('headings.prices') }}</a></li>
							@endif
							@if($user->hasWorkplace())
							<li><a href="#girl-workplace" data-toggle="tab">{{ __('headings.workplace') }}</a></li>
							@endif
							@if($user->working_time)
							<li><a href="#girl-workinghours" data-toggle="tab">{{ __('headings.working_time') }}</a></li>
							@endif
							@if($user->spoken_languages()->count())
							<li><a href="#girl-languages" data-toggle="tab">{{ __('headings.languages') }}</a></li>
							@endif
							@if($user->city)
							<li><a href="#girl-map" data-toggle="tab">{{ __('headings.map') }}</a></li>
							@endif
						</ul>
						<div class="tab-content">
							@if($user->videos)
							<div class="tab-pane" id="girl-videos">
								<video controls>
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
									<h4 style="display: inline-block; margin-right: 10px;"><strong>{{ __('headings.i_o_s_f') }}:</strong></h4>
									<span><strong>{{ getDataAndCutLastCharacter($user->service_options, 'service_option_name') }}</strong></span>
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
												<th>{{ __('fields.type') }}</th>
												<th>{{ __('headings.duration') }}</th>
												<th>{{ __('headings.price') }}</th>
											</tr>
										</thead>
										<tbody id="prices_body">
											@foreach ($user->prices->sortBy('price_type') as $price)
											<tr>
												<td>{{ ucfirst($price->price_type) }}</td>
												<td>{{ $price->service_duration . ' ' . trans_choice('fields.' . $price->service_price_unit, $price->service_duration) }}</td>
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
												<th>{{ __('buttons.day') }}</th>
												<th>{{ __('buttons.from') }}</th>
												<th>{{ __('buttons.to') }}</th>
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
												<td>{{ isset(explode('&', explode(' - ', explode('|', $workingTime)[1])[1])[1]) ? __('fields.night_escort') : '' }}</td>
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
												@php 
													$var = 'spoken_language_name_'. config()->get('app.locale');
												@endphp
												<td>{{ $spokenLanguage->$var }}</td>
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
									<div id="map" style="width: 100%; height: 450px;"></div>
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
					alert('{{ __('messages.geolocation_not_successful') }} ' + status);
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
var img = document.getElementsByClassName('expand')[0];

        
var modalImg = document.getElementById("img01");
        
        var all = modalImg.getAttribute("src").substr(-25 , 1) -1;
        
        
        function prev () {
            var now = modalImg.getAttribute("src").substr(-19 , 1);
            
            if (now == 0) {
                
                var prev = all;
            }
            
            else {
                var prev = now - 1;
            }
            
            var src = modalImg.getAttribute("src").replace("nth/"+now+"/-/resize/490x560/", "");
             
            
            var src = src + "nth/"+prev+"/-/resize/490x560/";
            
            modalImg.setAttribute("src", src); 

        }
        
        function next () {
            
            
            var now = modalImg.getAttribute("src").substr(-19 , 1);
            
            now = parseInt(now);

            
            if (now == all) {
                
                var next = 0;
            }
            
            else {
                var next = now + 1;
            }
            
            var src = modalImg.getAttribute("src").replace("nth/"+now+"/-/resize/490x560/", "");
             
            
            var src = src + "nth/"+next+"/-/resize/490x560/";
            
            modalImg.setAttribute("src", src);   


        }
        
        
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

<script>
	$('#gallery_01 img').click(function(e) {
		e.preventDefault();
		$('#is_image_large').attr('src',$(this).attr('src').replace('127x145','490x560'));
	});
</script>

<script>
    $('.modal').click(function(e) {
    if($(e.target).is('.modal'))  $(this).fadeOut(175);
});
</script>



@stop