@extends('layouts.app') @section('title', 'Girls') @section('styles')
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}"> @stop @section('content')
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
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_location" class="layout-title">


                                <a>Location <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('radius') ? 'display: none;' : '' }}">
                                <ul>
                                    <li class="slider">
                                        <label for="amount">Radius:</label>
                                        <div class="location-inputs">
                                            <input type="hidden" name="radius" value="{{ old('radius') }}">
                                        </div>
                                        <div id="radius-ranger" style="margin: 10px;"></div>
                                        <div class="slider-value-wrapper">
                                            <span class="radius">{{ old('radius') ? old('radius') : 0 }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout canton-layout headerDropdown">
                            <div id="toggle_arrow_canton" class="layout-title">

@section('title', __('buttons.private'))

                                <a>Canton <i class="fa fa-caret-right"></i></a>
                </div>
                            <div class="layout-list" style="{{ !request('canton') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        <?php $num = 1; ?> @foreach($cantons as $canton)
                                        <label class="control control--checkbox">

@section('content')
<div class="wrapper section-girls">
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
						<div class="shop-layout">
							<div class="layout-title">
								<h2>{{ __('fields.location') }}</h2>
							</div>
							<div class="layout-list"{{--  style="{{ !request('radius') ? 'display: none;' : '' }}" --}}>
								<ul>
									<li>
										<div class="city-input">
											<input type="text" name="city" value="" placeholder="{{ __('fields.city') }}">
											<a href="" onclick="getLocation()"><img src="{{ asset('svg/location.svg') }}" alt="location"></a>
										</div>
									</li>
									<li>
										<label for="amount">{{ __('fields.radius') }}:</label>
										<div class="location-inputs">
											<input type="hidden" name="radius" value="{{ old('radius') }}">
										</div>
										<div id="radius-ranger" style="margin: 10px;"></div>
										<div class="slider-value-wrapper">
											<span class="radius">{{ old('radius') ? old('radius') : 0 }}</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout canton-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.canton') }}</a>
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
                                        <?php $num++; ?> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_price" class="layout-title">

                                <a>Price <i class="fa fa-caret-right"></i></a>



                            </div>
                            <div class="layout-list" style="{{ !request('price_from') && !request('price_to') ? 'display: none;' : '' }}">
                                <ul>
                                    <li class="slider">
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
                        <div class="shop-layout services-layout headerDropdown">
                            <div id="toggle_arrow_service" class="layout-title">

                                <a>Service <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('services') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        @foreach($services as $service)
                                        <label class="control control--checkbox">

										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>

						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('headings.price') }}</a>
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
						<div class="shop-layout services-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.service') }}</a>
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

                                        <?php $num++; ?> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_type" class="layout-title">

                                <a>Type <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('type') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        <?php $num = 1; ?> @foreach(getTypes() as $key => $type)
                                        <label class="control control--checkbox">

										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.type') }}</a>
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

                                        <?php $num++; ?> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_hair" class="layout-title">

                                <a>Hair Color <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('hair_color') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        @foreach(getHairColors() as $hairColor)
                                        <label class="control control--checkbox">

										<?php $num++; ?>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.hair_color') }}</a>
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

										</label> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_breast" class="layout-title">

                                <a>Breast Size <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('breast_size') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        @foreach(getBreastSizes() as $breastSize)
                                        <label class="control control--checkbox">

										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.breast_size') }}</a>
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

										</label> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_age" class="layout-title">

                                <a>Age <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('age') ? 'display: none;' : '' }}">
                                <ul>
                                    <?php $num = 1; ?> @foreach (getFilterYears() as $startAge => $endAge)
                                    <li>
                                        <label class="control control--checkbox">
										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.age') }}</a>
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
                                    <?php $num++; ?> @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout headerDropdown">
                            <div id="toggle_arrow_escort" class="layout-title">

                                <a>Escorting <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('price_type') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        @foreach(getPriceTypes() as $priceType) @php $priceTypeQueryString = ['price_type' => $priceType]; $completeQueryString = []; $requestQuery = request()->query(); if (!empty($requestQuery)) { if (array_key_exists('price_type', $requestQuery)) { if (!array_search($priceType, $requestQuery)) { $completeQueryString = array_merge($requestQuery, $priceTypeQueryString); } else { unset($requestQuery['price_type']); $completeQueryString = $requestQuery; } } else { $completeQueryString = array_merge($requestQuery, $priceTypeQueryString); } } else { $completeQueryString = array_merge($requestQuery, $priceTypeQueryString); } @endphp
                                        <label class="control control--checkbox">
									</li>
									<?php $num++; ?>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="shop-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('fields.incall_outcall') }}</a>
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

										</label> @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-layout services-layout headerDropdown">
                            <div id="toggle_arrow_lang" class="layout-title">

                                <a>Languages <i class="fa fa-caret-right"></i></a>
                            </div>
                            <div class="layout-list" style="{{ !request('spoken_languages') ? 'display: none;' : '' }}">
                                <ul>
                                    <li>
                                        @foreach($spokenLanguages as $spokenLanguage)
                                        <label class="control control--checkbox">

										</label>
										@endforeach
									</li>
								</ul>
							</div>
						</div>
						<div class="shop-layout services-layout">
							<div class="layout-title">
								<img class="right_side_arrow" src="./svg/caret-right.svg" alt="down arrow">
								<a>{{ __('headings.language') }}</a>
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

                                        <?php $num++; ?> @endforeach
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
                                        <li><a title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
                                    </ul>
                                </div>
                                <div class="toolbar">
                                    <div class="sorter">
                                        <div class="sort-by">
                                            <label class="sort-none">Sort By</label>
                                            <select name="order_by" onchange="location=this.value;" ">

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
											<label class="sort-none">Sort By</label>
											<select name="order_by" onchange="location=this.value;"">

												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route( 'girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
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
											</select> per page
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="filters-reset">
                                    <a href="{{ url('girls') }}" class="btn btn-default">Reset Filters</a>
                                </div>
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
                                        <li><a title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
                                    </ul>
                                </div>
                                <div class="toolbar">
                                    <div class="sorter">
                                        <div class="sort-by">
                                            <label class="sort-none">Sort By</label>
                                            <select name="order_by" onchange="location=this.value;" ">

											<a class="up-arrow" href="shop.html#"><i class="fa fa-long-arrow-up"></i></a>
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
															<a class="a-img" href="shop.html#"><img class="primary-img" src="http://www.ucarecdn.com/465dc041-0b41-4b96-9f66-2240f4637843~7/nth/2/-/resize/263x300/" alt="" />
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
										<li class="active"><a title="Grid" data-toggle="tab" href="shop.html#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Grid</span></a></li>
										<li><a  title="List" data-toggle="tab" href="shop.html#shop-list"><i class="fa fa-list"></i><span class="list">List</span></a></li>
									</ul>
								</div>
								<div class="toolbar">
									<div class="sorter">
										<div class="sort-by">
											<label class="sort-none">{{ __('global.sort_by') }}</label>
											<select name="order_by" onchange="location=this.value;"">
												@foreach(getOrderBy() as $key => $order)
												<option value="{{ urldecode(route( 'girls', array_merge(request()->query(), ['order_by' => $key]), false)) }}" {{ request('order_by') == $key ? 'selected' : '' }}>{{ $order }}</option>
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
@stop @section('perPageScripts')

<script>

    var initialRadius = '{{ old('
    radius ') ? old('
    radius ') : 0 }}';
    $('#radius-ranger').slider({
        range: 'min',
        min: 0,
        max: 20,
        value: initialRadius,
        slide: function(event, ui) {
            $('.radius').text(ui.value);
        },
        change: function(event, ui) {

            var input = $('input[name="radius"]');
            var $radius = input.val(ui.value);

            var $url = getUrl('/get_radius');

            var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query())  ? json_encode(request()->query()) : "{}" }}';

            var requestQueryClearedJSON = requestQueryString
                .replace(/&quot;/gi, "\"")
                .replace(/\[/gi, "")
                .replace(/\]/gi, "");

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
                success: function(data) {
                    window.location.href = data.url;
                },
                error: function(data) {}
            });
        }
    });

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

			var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query())  ? json_encode(request()->query()) : "{}" }}';

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
    $(function() {
        var slider = $("#price-ranger");
        var initialPriceFrom = '{{ old('
        price_from ') }}';
        var initialPriceTo = '{{ old('
        price_to ') }}' != '' ? '{{ old('
        price_to ') }}': '{{ $maxPrice }}';
        slider.slider({
            range: true,
            min: 0,
            max: '{{ $maxPrice }}',
            values: [initialPriceFrom, initialPriceTo],
            slide: function(event, ui) {
                $('.price-value-from').text(ui.values[0]);
                $('.price-value-to').text(ui.values[1]);
            },
            change: function(event, ui) {

                var priceInputsWrapper = $('.price-inputs');
                var $priceFrom = priceInputsWrapper.find('input:first-child').val(ui.values[0]);
                var $priceTo = priceInputsWrapper.find('input:last-child').val(ui.values[1]);

                var $url = getUrl('/get_price_ranges');

                var requestQueryString = '{{ is_array(request()->query()) ? json_encode(request()->query()) : "{}" }}';

                var requestQueryClearedJSON = requestQueryString.replace(/&quot;/gi, "\"")
                    .replace(/\[/gi, "")
                    .replace(/\]/gi, "");

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
                    success: function(data) {
                        // console.log(data.url);
                        window.location.href = data.url;
                    },
                    error: function(data) {
                        // console.log('error');
                    }
                });
            }
        });
    });
</script>
<!-- Filters -->
<script>
    $(function() {
        $('.layout-title').on('click', function() {
            var that = $(this);
            that.closest('.shop-layout').find('.layout-list').toggle('fast');
        });
    });
</script>
<script>
    $('.control__indicator').on('click', function() {
        window.location.href = $(this).closest('label').find('a').attr('href');
    });
</script>

<script>
        $("#toggle_arrow_location").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_canton").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });

    $("#toggle_arrow_price").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_service").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });

    $("#toggle_arrow_type").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_hair").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_breast").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_age").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_escort").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
    $("#toggle_arrow_lang").on("click", function() {
        $(this).parent().find(".fa-caret-right").toggleClass("rotateCaret");
    });
</script>

@stop