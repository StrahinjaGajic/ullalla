@extends('layouts.app')

@section('title', __('buttons.private'))

@section('styles')
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="wrapper section-girls">
	<div class="shop-header-banner">
		<span><img src="{{ url('img/banner/profil-banner.jpg') }}" alt=""></span>
	</div>
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="{{ url('/') }}">{{ __('buttons.home') }}</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>{{ __('buttons.private') }}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shop-product-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="left-sidebar-title">
						<h2>{{ __('headings.search_filters') }}</h2>
					</div>
					<div class="left-sidebar">
						<div class="shop-layout headerDropdown">
							<div class="layout-title toggle_arrow">
								<a>{{ __('fields.location') }} <i class="fa fa-caret-right"></i></a>
							</div>
							<div class="layout-list"{{--  style="{{ !request('radius') ? 'display: none;' : '' }}" --}}>
								<ul>
									<li class="geolocation">
										<input name="city" id="city" placeholder="{{ __('fields.city') }}" class="form-control" value="{{ Session::has('address') ? Session::get('address') : '' }}" />
										<a onclick="getLocation();" class="geolocation-button">
											<img src="{{ asset('svg/location.svg') }}" alt="" class="geolocation-image">
											<div class="spinner" style="display: none;">
												<div class="double-bounce1"></div>
												<div class="double-bounce2"></div>
											</div>
										</a>
									</li>
									<li>
										<label for="amount">{{ __('fields.radius') }}:</label>
										<div class="location-inputs">
											<input type="hidden" name="radius" value="{{ old('radius') }}">
										</div>
										<div id="radius-ranger" style="margin: 10px;"></div>
										<div class="slider-value-wrapper">
											<span class="radius">{{ old('radius') ? old('radius') : 0 }}</span>
											<span>{{ __('global.km') }}</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout canton-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.canton') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('canton') ? 'display: none;' : '' }}">
								<ul>
									<li>
										<?php $num = 1; ?>
										@foreach($cantons as $canton)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('canton'), request()->query() , $num, 'canton', $canton), false)) }}">{{ $canton->canton_name }}
												<span>({{ $canton->users()->approved()->payed()->count() }})</span>
											</a>
											<input type="checkbox" name="canton[]" value="{{ $canton->id }}" {{ request('canton') && in_array($canton->id, request('canton')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('headings.price') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('price_from') && !request('price_to') ? 'display: none;' : '' }}">
								<ul>
									<li>
										<label for="amount">{{ __('fields.price_range') }}:</label>
										<div class="price-inputs">
											<input type="hidden" name="price_from" value="{{ old('price_from') }}">
											<input type="hidden" name="price_to" value="{{ old('price_to') }}">
										</div>
										<div id="price-ranger" style="margin: 10px;"></div>
										<div class="slider-value-wrapper">
											<span class="price-value-from">{{ old('price_to') ? old('price_from') : 0 }}</span>
											<span> - </span>
											<span class="price-value-to">{{ old('price_to') ? old('price_to') : $maxPrice }}</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout services-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.service') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('services') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach($services as $service)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('services'), request()->query() , $num, 'services', $service), false)) }}">{{ $service->service_name }}
												<span>({{ $service->users()->approved()->payed()->count() }})</span>
											</a>
											<input type="checkbox" name="services[]" value="{{ $service->id }}" {{ request('services') && in_array($service->id, request('services')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.type') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('type') ? 'display: none;' : '' }}">
								<ul>
									<li>
										<?php $num = 1; ?>
										@foreach(getTypes() as $key => $type)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('types'), request()->query() , $num, 'types', $type), false)) }}">{{ $type }}
												<span>({{ \App\Models\User::approved()->payed()->where('type', strtolower($type))->count() }})</span>
											</a>
											<input type="checkbox" name="types[]" value="{{ $type }}" {{ request('types') && in_array($type, request('types')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.hair_color') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('hair_color') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach(getHairColors() as $hairColor)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('hair_color'), request()->query() , $num, 'hair_color', $hairColor), false)) }}">{{ $hairColor }}
												<span>({{ \App\Models\User::approved()->payed()->where('hair_color', strtolower($hairColor))->count() }})</span>
											</a>
											<input type="checkbox" name="hair_color[]" value="{{ $hairColor }}" {{ request('hair_color') && in_array($hairColor, request('hair_color')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.breast_size') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('breast_size') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach(getBreastSizes() as $breastSize)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('breast_size'), request()->query() , $num, 'breast_size', $breastSize), false)) }}">{{ $breastSize }}
												<span>({{ \App\Models\User::approved()->payed()->where('breast_size', strtolower($breastSize))->count() }})</span>
											</a>
											<input type="checkbox" name="breast_size[]" value="{{ $breastSize }}" {{ request('breast_size') && in_array($breastSize, request('breast_size')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.age') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('age') ? 'display: none;' : '' }}">
								<ul>
									<?php $num = 1; ?>
									@foreach (getFilterYears() as $startAge => $endAge)
									<li>
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('age'), request()->query() , $num, 'age', makeStringFromFilterYears($startAge, $endAge)), false)) }}">
												{{ makeStringFromFilterYears($startAge, $endAge) }} Years
												<span>({{ \App\Models\User::approved()->payed()->whereBetween('age', [$startAge, $endAge])->count() }})</span>
											</a>
											<input type="checkbox" name="age[]" value="18" {{ request('age') && in_array(makeStringFromFilterYears($startAge, $endAge), request('age')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
									</li>
									<?php $num++; ?>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="shop-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('fields.incall_outcall') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('price_type') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach(getPriceTypes() as $priceType)
										@php 
										$priceTypeQueryString = ['price_type' => $priceType];
										$completeQueryString = [];
										$requestQuery = request()->query();
										if (!empty($requestQuery)) {
											if (array_key_exists('price_type', $requestQuery)) {
												if (!array_search($priceType, $requestQuery)) {
													$completeQueryString = array_merge($requestQuery, $priceTypeQueryString);
												} else {
													unset($requestQuery['price_type']);
													$completeQueryString = $requestQuery;
												}
											} else {
												$completeQueryString = array_merge($requestQuery, $priceTypeQueryString);
											}
										} else {
											$completeQueryString = array_merge($requestQuery, $priceTypeQueryString);
										}
										@endphp

										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', $completeQueryString, false)) }}">{{ ucfirst($priceType) }}
												<span>({{ \App\Models\User::approved()->payed()->whereNotNull($priceType . '_type')->count() }})</span>
											</a>
											<input type="radio" name="price_type" value="{{ $priceType }}" {{ request('price_type') && $priceType == request('price_type') ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout services-layout headerDropdown">
							<div class="layout-title">
								<div class="layout-title toggle_arrow">
									<a>{{ __('headings.language') }} <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
							<div class="layout-list" style="{{ !request('spoken_languages') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach($spokenLanguages as $spokenLanguage)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('spoken_languages'), request()->query() , $num, 'spoken_languages', $spokenLanguage), false)) }}">{{ $spokenLanguage->spoken_language_name }}
												<span>({{ $spokenLanguage->users()->approved()->payed()->count() }})</span>
											</a>
											<input type="checkbox" name="spoken_languages[]" value="{{ $spokenLanguage->spoken_language_code }}" {{ request('spoken_languages') && in_array($spokenLanguage->spoken_language_code, request('spoken_languages')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
					<div class="shop-product-view">
						<div class="product-tab-area">
							<div class="tab-bar">
								<div class="tab-bar-inner">
									<ul role="tablist" class="nav nav-tabs">
										<li class="active">
											<a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">{{ __('buttons.grid') }}</span>
											</a>
										</li>
										<li>
											<a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">{{ __('buttons.list') }}</span>
											</a>
										</li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">{{ __('global.sort_by') }}</label>
											<select name="order_by" onchange="location=this.value;">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="pager-list">
										<div class="limiter">
											<label>{{ __('global.show') }}</label>
											<select name="show" onchange="location=this.value">
												@foreach(getShowNumbers() as $number)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['show' => $number]), false)) }}" {{ request('show') == $number ? 'selected' : '' }}>{{ $number }}</option>
												@endforeach
											</select>
											{{ __('global.per_page') }}
										</div>
									</div>
								</div>
							</div>
							<div class="tab-content">
								<div class="filters-reset">
									<a href="{{ url('girls') }}" class="btn btn-default">{{ __('buttons.reset_filters') }}</a>
								</div>
								@if ($users->count())
								<div id="shop-product" class="tab-pane active">
									<div class="row">
										@foreach($users as $user)
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-product">
												<div class="product-img">
													<a class="a-img"><img class="primary-img" src="{{ $user->photos . 'nth/0/-/resize/263x300/' }}" alt="profile image" />
													</a>
												</div>
												<div class="product-content">
													<a class="shop-name">{{ $user->nickname }}</a>
													<div class="pro-price"></div>
													<a href="{{ url('girls/' . $user->nickname) }}">
														<div class="product-cart">
															<button class="button">{{ __('buttons.view_profile') }}</button>
														</div>
													</a>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								<div id="shop-list" class="tab-pane">
									@foreach($users as $user)
									<div class="single-shop single-product">
										<div class="row">
											<div class="single-shop">
												<div class="single-product">
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<div class="product-img">
															<a class="a-img" href="shop.html#"><img class="primary-img" src="{{ $user->photos . 'nth/0/-/resize/263x300/' }}" alt="profile image" />
															</a>
														</div>
													</div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<div class="product-content-shop">
															<h2><a class="shop-name">{{ $user->nickname }}</a></h2>
															<div class="pro-deal-text-shop">
																<p>{{ Str::words($user->about_me, 40) }}</p>
															</div>
															<a href="{{ url('girls/' . $user->nickname) }}">
																<div class="product-cart">
																	<button class="button">{{ __('buttons.view_profile') }}</button>
																</div>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@else
								<h1>{{ __('headings.no_users_found') }}</h1>
								@endif
							</div>
							<div class="tab-bar tab-bar-bottom">
								<div class="tab-bar-inner">
									<ul role="tablist" class="nav nav-tabs">
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">{{ __('buttons.grid') }}</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">{{ __('buttons.list') }}</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">{{ __('global.sort_by') }}</label>
											<select name="order_by" onchange="location=this.value;">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="pages">
										{{ $users->appends(request()->input())->links('vendor.pagination.custom-girls') }}
									</div>
								</div>
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
								<img src="img/banner/fullwide-banner-4.jpg" alt="">
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
@stop

@section('perPageScripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&libraries=places&callback=initialize"></script>
<script>
	var initialRadius = '{{ old('radius') ? old('radius') : 0 }}';
	$('#radius-ranger').slider({
		range: 'min',
		min: 0,
		max: 20,
		value: initialRadius,
		slide: function( event, ui ) {
			$('.radius').text(ui.value);
		},
		change: function( event, ui ) {

			var input = $('input[name="radius"]');
			var $radius = input.val(ui.value);

			var $url = getUrl('/get_radius');

			var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query()) ? json_encode(request()->query()) : "{}" }}';

			var requestQueryClearedJSON = requestQueryString
			.replace(/&quot;/gi,"\"")
			.replace(/\[/gi,"")
			.replace(/\]/gi,"");

			var requestQueryObj = JSON.parse(requestQueryClearedJSON);

			delete requestQueryObj.radius;

			var requestData = Object.assign({
				radius: $radius.val()
			}, requestQueryObj);

			console.log(requestData);

			$.ajax({
				data: requestData,
				url: $url,
				dataType: 'json',
				method: 'get',
				success: function (data) {
					window.location.href = data.url;
				},
				error: function (data) {
				}
			});
		}
	});
</script>

<script>
	$( function() {
		var slider = $( "#price-ranger" );
		var initialPriceFrom = '{{ old('price_from') }}';
		var initialPriceTo = '{{ old('price_to') }}' != '' ? '{{ old('price_to') }}' : '{{ $maxPrice }}';
		slider.slider({
			range: true,
			min: 0,
			max: '{{ $maxPrice }}',
			values: [initialPriceFrom, initialPriceTo],
			slide: function( event, ui ) {
				$('.price-value-from').text(ui.values[0]);
				$('.price-value-to').text(ui.values[1]);
			},
			change: function( event, ui ) {

				var priceInputsWrapper = $('.price-inputs');
				var $priceFrom = priceInputsWrapper.find('input:first-child').val(ui.values[0]);
				var $priceTo = priceInputsWrapper.find('input:last-child').val(ui.values[1]);

				var $url = getUrl('/get_price_ranges');

				var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query()) ? json_encode(request()->query()) : "{}" }}';

				var requestQueryClearedJSON = requestQueryString.replace(/&quot;/gi,"\"")
				.replace(/\[/gi,"")
				.replace(/\]/gi,"");

				var requestQueryObj = JSON.parse(requestQueryClearedJSON);

				delete requestQueryObj.price_to;
				delete requestQueryObj.price_from;

				var requestData = Object.assign({
					price_from: $priceFrom.val(), 
					price_to: $priceTo.val()
				}, requestQueryObj);

				$.ajax({
					data: requestData,
					url: $url,
					dataType: 'json',
					method: 'get',
					success: function (data) {
						// console.log(data.url);
						window.location.href = data.url;
					},
					error: function (data) {
						// console.log('error');
					}
				});
			}
		});
	} );
</script>
<!-- Filters -->
<script>
	$('.control__indicator').on('click', function () {
		window.location.href = $(this).closest('label').find('a').attr('href');
	});
</script>
<script>
	$(".toggle_arrow").on("click", function() {
		var that = $(this);
		that.closest('.shop-layout').find('.layout-list').toggle('fast');
		that.parent().find(".fa-caret-right").toggleClass("rotateCaret");
	});
</script>

<!-- geolocation -->
<script>
	var x = document.getElementById("location");
	var inputCity = document.getElementById('city');
	var token = '{{ csrf_token() }}';

	function initialize() {
		var autocomplete = new google.maps.places.Autocomplete(
			(inputCity), {
				types: ['geocode']
			});
		autocomplete.setComponentRestrictions({'country': ['ch']});

		autocomplete.addListener('place_changed', function() { 
			$('.geolocation-image').hide();
			$('.spinner').show();
			var place = autocomplete.getPlace();
			var lat = place.geometry.location.lat();
			var lng = place.geometry.location.lng();
			var address = place.formatted_address;
			console.log(place);
			$.ajax({
				url: getUrl('/get_guest_data'),
				type: 'post',
				data: {lat: lat, lng: lng, address: address, _token: token},
				success: function (data) {
					window.location.reload();
				}
			});
		});                  
	}

	function getLocation() {
		$('.geolocation-image').hide();
		$('.spinner').show();
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function (position) {
				var geocoder = new google.maps.Geocoder;
				var lat = position.coords.latitude;
				var lng = position.coords.longitude;
				var latlng = {
					lat: lat, 
					lng: lng
				};
				geocoder.geocode({'location': latlng}, function(results, status) {
					if (results[0]) {
						console.log(results);
						var address = results[0].formatted_address;
						inputCity.value = address;
						$.ajax({
							url: getUrl('/get_guest_data'),
							type: 'post',
							data: {lat: lat, lng: lng, address: address, _token: token},
							success: function (data) {
								window.location.reload();
							}
						});
					}
				});
			});	
		} else {
			x.innerHTML = "{{ __('messages.geolocation_not_supported') }}";
		}
	}
</script>
@stop