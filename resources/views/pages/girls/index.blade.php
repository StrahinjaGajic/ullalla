@extends('layouts.app')

@section('title', 'Girls')

@section('styles')
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="wrapper section-girls">
	<div class="single-product-menu">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="shop-menu">
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li class="separator"><i class="fa fa-angle-right"></i></li>
							<li>search results</li>
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
						<h2>Search Filter</h2>
					</div>
					<div class="left-sidebar">
						<div class="shop-layout canton-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Canton</a>
								
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

						<div class="shop-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Price</a>
							</div>
							<div class="layout-list" style="{{ !request('price_from') && !request('price_to') ? 'display: none;' : '' }}">
								<ul>
									<li>
										<label for="amount">Price range:</label>
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
						<div class="shop-layout services-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Service</a>
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
						<div class="shop-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Type</a>
							</div>
							<div class="layout-list" style="{{ !request('type') ? 'display: none;' : '' }}">
								<ul>
									<li>
										<?php $num = 1; ?>
										@foreach(getTypes() as $key => $type)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('type'), request()->query() , $num, 'type', $type), false)) }}">{{ $type }}
												<span>({{ \App\Models\User::approved()->payed()->where('type', strtolower($type))->count() }})</span>
											</a>
											<input type="checkbox" name="type[]" value="{{ $type }}" {{ request('type') && in_array($type, request('type')) ? 'checked' : '' }}/>
											<div class="control__indicator"></div>
										</label>
										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Hair Color</a>
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
						<div class="shop-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Breast Size</a>
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
						<div class="shop-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Age</a>
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
						<div class="shop-layout">
							<div class="layout-title">
                               <img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
                                <a>Escorting</a>
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
						<div class="shop-layout services-layout">
							<div class="layout-title">
							<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>Languages</a>
							</div>
							<div class="layout-list" style="{{ !request('spoken_languages') ? 'display: none;' : '' }}">
								<ul>
									<li>
										@foreach($spokenLanguages as $spokenLanguage)
										<label class="control control--checkbox">
											<a href="{{ urldecode(route('girls', getUrlWithFilters(request('spoken_languages'), request()->query() , $num, 'spoken_languages', $spokenLanguage), false)) }}">{{ $spokenLanguage->spoken_language_name }}
												<span>({{ $spokenLanguage->users()->approved()->payed()->count() }})</span>
											</a>
											<input type="checkbox" name="spoken_languages[]" value="{{ $spokenLanguage->id }}" {{ request('spoken_languages') && in_array($spokenLanguage->id, request('spoken_languages')) ? 'checked' : '' }}/>
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
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Grid</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">Sort By</label>
											<select name="order_by" onchange="location=this.value;"">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
											<a class="up-arrow" href="shop.html#"><i class="fa fa-long-arrow-up"></i></a>
										</div>
									</div>
									<div class="pager-list">
										<div class="limiter">
											<label>Show</label>
											<select name="show" onchange="location=this.value">
												@foreach(getShowNumbers() as $number)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['show' => $number]), false)) }}" {{ request('show') == $number ? 'selected' : '' }}>{{ $number }}</option>
												@endforeach
											</select>
											per page
										</div>
									</div>
								</div>
							</div>
							<div class="tab-content">
								@if ($users->count())
								<div id="shop-product" class="tab-pane active">
									<div class="row">
										@foreach($users as $user)
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-product">
												<div class="product-img">
													<a class="a-img"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
													</a>
												</div>
												<div class="product-content">
													<a class="shop-name">{{ $user->nickname }}</a>
													<div class="pro-price">
														<p>short info</p>
													</div>
													<a href="{{ url('girls/' . $user->nickname) }}">
														<div class="product-cart">
															<button class="button">View Profile</button>
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
															<a class="a-img" href="shop.html#"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
															</a>
														</div>
													</div>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<div class="product-content-shop">
															<h2><a class="shop-name">{{ $user->nickname }}</a></h2>
															<div class="pro-deal-text-shop">
																<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Viva... </p>
															</div>
															<a href="{{ url('girls/' . $user->nickname) }}">
																<div class="product-cart">
																	<button class="button">View Profile</button>
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
								<h1>No Users Found</h1>
								@endif
							</div>
							<div class="tab-bar tab-bar-bottom">
								<div class="tab-bar-inner">
									<ul role="tablist" class="nav nav-tabs">
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Grid</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">Sort By</label>
											<select name="order_by" onchange="location=this.value;"">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route('girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
												@endforeach
											</select>
											<a class="up-arrow" href="shop.html#"><i class="fa fa-long-arrow-up"></i></a>
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

				var requestQueryString = '{{ is_array(request()->query()) ? json_encode(request()->query()) : "{}" }}';

				var requestQueryClearedJSON = requestQueryString.replace(/&quot;/gi,"\"")
				.replace(/\[/gi,"")
				.replace(/\]/gi,"");

				var requestQueryClearedJSON = JSON.stringify({});
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
	$(function () {
		$('.layout-title').on('click', function() {
			var that = $(this);
			that.closest('.shop-layout').find('.layout-list').toggle('fast');
		});
	});
</script>
@stop