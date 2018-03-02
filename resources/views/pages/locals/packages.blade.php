@extends('layouts.app')

@section('title', __('headings.packages'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
@stop

@section('content')
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditLocalProfileMenu('packages') !!}
		</div>
		<?php $counter = 1; ?>
		<div class="col-sm-10 profile-info">
			<div class="col-xs-12">
				@if(Session::has('success_scheduled'))
					<div class="alert alert-success">{{ Session::get('success_scheduled') }}</div>
				@endif
				@if(Session::has('success_d_package_updated'))
					<div class="alert alert-success">{{ Session::get('success_d_package_updated') }}</div>
				@endif
				@if(Session::has('success_gotm_package_updated'))
					<div class="alert alert-success">{{ Session::get('success_gotm_package_updated') }}</div>
				@endif

				<ul class="packages-errors {{ $errors->has('stripe_error') || $errors->has('ullalla_package') || $errors->has('ullalla_package_month_girl') ? 'alert alert-danger' : '' }}">
					@if ($errors->has('stripe_error') || $errors->has('ullalla_package') || $errors->has('ullalla_package_month_girl'))
                    	<li>{{ $errors->first() }}</li>
                	@endif
				</ul>
			</div>

			@if($user->is_active_d_package || $user->is_active_gotm_package)
				<div class="col-xs-12">
					<h3>{{ __('headings.active_packages') }}</h3>
					<table class="table">
						<thead>
							<tr>
								<th>{{ __('fields.type') }}</th>
								<th>{{ __('headings.activation_date') }}</th>
								<th>{{ __('headings.expiry_date') }}</th>
							</tr>
						</thead>	
						<tbody>
							@if($user->is_active_d_package)
								<tr>
									<td>{{ __('headings.default_package') }}</td>
									<td>{{ date('d-m-Y', strtotime($user->package1_activation_date)) }}</td>
									<td>{{ date('d-m-Y', strtotime($user->package1_expiry_date)) }}</td>
								</tr>
							@endif
							@if($user->is_active_gotm_package)
								<tr>
									<td>{{ __('headings.lotm_package') }}</td>
									<td>{{ date('d-m-Y', strtotime($user->package2_activation_date)) }}</td>
									<td>{{ date('d-m-Y', strtotime($user->package2_expiry_date)) }}</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			@endif

			@if($scheduledDefaultPackage || $scheduledGotmPackage)
				<div class="col-xs-12">
					<h3>{{ __('headings.scheduled_packages') }}</h3>
					<table class="table">
						<thead>
							<tr>
								<th>{{ __('fields.type') }}</th>
								<th>{{ __('headings.activation_date') }}</th>
								<th>{{ __('headings.expiry_date') }}</th>
							</tr>
						</thead>	
						<tbody>
							@if($scheduledDefaultPackage)
								@php
									$scheduledDefaultPackage = explode('&|', $scheduledDefaultPackage);
								@endphp
								<tr>
									<td>{{ __('headings.default_package') }}</td>
									<td>{{ date('d-m-Y', strtotime($scheduledDefaultPackage[2])) }}</td>
									<td>{{ date('d-m-Y', strtotime($scheduledDefaultPackage[3])) }}</td>
								</tr>
								@endif
								@if($scheduledGotmPackage)
								@php
									$scheduledGotmPackage = explode('&|', $scheduledGotmPackage);
								@endphp
								<tr>
									@if($user->sex == 'transsexual')
										<td>{{ __('headings.totm_package') }}</td>
									@else
										<td>{{ __('headings.gotm_package') }}</td>
									@endif
									<td>{{ date('d-m-Y', strtotime($scheduledGotmPackage[2])) }}</td>
									<td>{{ date('d-m-Y', strtotime($scheduledGotmPackage[3])) }}</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			@endif

			@if($showDefaultPackages || $showGotmPackages)
				{!! Form::model($user, ['url' => 'locals/@' . $user->username . '/packages/store', 'id' => 'profileForm', 'method' => 'PUT']) !!}
				@if($showDefaultPackages)
					<div class="col-xs-12 default-packages-section" id="default-packages-section">
						<h3>{{ __('headings.default_packages') }}</h3>
						<table class="table packages-table">
							<thead>
								<tr>
									<th class="text-center">{{ __('headings.name') }}</th>
									<th class="text-center">{{ __('headings.duration') }}</th>
									<th class="text-center">{{ __('headings.price') }}</th>
									<th class="text-center">{{ __('headings.activation_date') }}</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
							@foreach ($packages as $package)
								<tr>
									@if($package->id == 6)
										<td colspan="4"><p>More Girls?</p></td>
									@else
										<td class="text-center">{{ $package->name }}</td>
										<td class="text-center">
											<select name="package_duration[{{ $package->id }}]" id="selectDur_{{ $package->id }}" onchange="changePrice('{{ $package->id }}', '{{ $package->month_price }}', '{{ $package->year_price }}', '{{ $package->package_discount }}', '{{ callTotalPackagePrice($package->month_price, $package->package_discount, 0) }}', '{{ callTotalPackagePrice($package->year_price, $package->package_discount, 0) }}')">
												<option value="month">{{ __('tables.month') }}</option>
												<option value="year">{{ __('tables.year') }}</option>
											</select>
										</td>
										<td class="text-center">
											@if($package->package_discount && $package->package_discount != 0)
												<span id="price_{{ $package->id }}" style="text-decoration:line-through; font-size:12px">{{ $package->month_price }} CHF</span>
											@else
												<span id="price_{{ $package->id }}">{{ $package->month_price }} CHF</span>
											@endif
											@if($package->package_discount && $package->package_discount != 0)
												<p>
													<span id="discountPercent_{{ $package->id }}" style="color:#f26522;">{{ $package->package_discount }}%</span> |
													<span id="discount_{{ $package->id }}" style="font-weight: bold;">{{ callTotalPackagePrice($package->month_price, $package->package_discount, 0) }} CHF</span>
												</p>
											@endif
										</td>
										<td class="text-center">
											<input type="text" name="default_package_activation_date[{{ $package->id }}]" class="package_activation" id="package_activation">
										</td>
									@endif
									<td>
										<label class="control control--checkbox">
											<input type="radio" name="ullalla_package[]" value="{{ $package->id }}" />
											<div class="control__indicator" onclick="{{ ($package->id == 6) ? 'hideLotm()' : 'showLotm()' }}"></div>
										</label>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif

				@if($showGotmPackages)
					<div id="lotm" class="col-xs-12">
						<h3>{{ __('headings.lotm_package') }}</h3>
						<table class="table packages-table package-girl-month">
							<thead>
							<tr>
								<th class="text-center">{{ __('headings.name') }}</th>
								<th class="text-center">{{ __('headings.duration') }}</th>
								<th class="text-center">{{ __('headings.price') }}</th>
								<th class="text-center">{{ __('headings.activation_date') }}</th>
								<th class="text-center"></th>
							</tr>
							</thead>
							<tbody>
							@foreach ($girlPackages->take(3) as $package)
								<tr>
									<td class="text-center">{{ $package->package_name }}</td>
									<td class="text-center">{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
									<td class="text-center">
										@if(explode(',', $package->package_discount)[2] && explode(',', $package->package_discount)[2] != 0)
											<span id="price_{{ $package->id }}" style="text-decoration:line-through; font-size:12px">{{ $package->package_price_local }} CHF</span>
										@else
											<span id="price_{{ $package->id }}">{{ $package->package_price_local }} CHF</span>
										@endif
										@if(explode(',', $package->package_discount)[2] && explode(',', $package->package_discount)[2] != 0)
											<p>
												<span style="color:#f26522;">{{ explode(',', $package->package_discount)[2] }}%</span> |
												<span style="font-weight: bold;">{{ callTotalPackagePrice($package->package_price_local, $package->package_discount, 2) }} CHF</span>
											</p>
										@endif
									</td>
									<td class="text-center">
										<input type="text" name="month_girl_package_activation_date[{{ $package->id }}]" class="package_month_girl_activation" id="package_month_activation{{ $counter }}">
									</td>
									<td class="text-center">
										<label class="control control--checkbox">
											<input type="checkbox" class="gotm_checkbox" name="ullalla_package_month_girl[]" value="{{ $package->id }}"/>
											<div class="control__indicator"></div>
										</label>
									</td>
								</tr>
								<?php $counter++; ?>
							@endforeach
							</tbody>
						</table>
					</div>
				@endif
				<button type="submit" class="btn btn-default">{{ __('buttons.pay_now') }}</button>
				<input type="hidden" name="stripeToken" id="stripeToken">
				<input type="hidden" name="stripeEmail" id="stripeEmail">
				{!! Form::close() !!}
			@endif
		</div>
	</div>
</div>
<div id="loading" class="is-hidden">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="loading-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>
@stop

@section('perPageScripts')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>

@if(Session::has('expired_package_info'))
<script>
    swal(
        '{{ __('headings.default_error_title') }}',
        '{{ Session::get('expired_package_info') }}',
		'{{ __('messages.error') }}'
    );
</script>
@endif
<script>

	function changePrice(id, month, year, discountPercent, discount_month, discount_year){
		var price = $('#selectDur_' + id + ' :selected').val();
		if(price == 'month'){
			price = month;
			if(discountPercent != 0){
				$('#discountPercent_' + id).text(discountPercent + '%');
				$('#discount_' + id).text(discount_month + ' CHF');
			}
		}else if(price == 'year'){
			price = year;
			if(discountPercent != 0){
				$('#discountPercent_' + id).text(discountPercent + '%');
				$('#discount_' + id).text(discount_year + ' CHF');
			}
		}
		$('#price_' + id).text(price + ' CHF');
	}


	// get new start and end year
	var start = new Date();
	start.setFullYear(start.getFullYear());
	var end = new Date();
	end.setFullYear(end.getFullYear() + 1);

	var package1ExpiryDate = '{{ $user->package1_expiry_date }}';
	var package2ExpiryDate = '{{ $user->package2_expiry_date }}';

	var defaultPackageStartDate = package1ExpiryDate != '' ? JSON.parse('{!! json_encode([$user->package1_expiry_date]) !!}') : start;
	var defaultPackageStartDate = package1ExpiryDate != '' ? new Date(defaultPackageStartDate[0]) : defaultPackageStartDate;
	var defaultPackageStartDate = new Date() > defaultPackageStartDate ? new Date() : defaultPackageStartDate;

	var gotmPackageStartDate = package2ExpiryDate != '' ? JSON.parse('{!! json_encode([$user->package2_expiry_date]) !!}') : start;
	var gotmPackageStartDate = package2ExpiryDate != '' ? new Date(gotmPackageStartDate[0]) : gotmPackageStartDate;
	var gotmPackageStartDate = new Date() > gotmPackageStartDate ? new Date() : gotmPackageStartDate;

	$(function () {
		$('.package_month_girl_activation').each(function () {
			$(this).daterangepicker({
				singleDatePicker: true,
				timepicker: false,
				showDropdowns: true,
				minDate: gotmPackageStartDate,
				maxDate: end,
				locale: {
					format: 'DD-MM-YYYY'
				},
			});;
		});
		// implement datarange picker on package activation input
		$('.package_activation').each(function () {
			$(this).daterangepicker({
				singleDatePicker: true,
				timepicker: false,
				showDropdowns: true,
				minDate: defaultPackageStartDate,
				maxDate: end,
				locale: {
					format: 'DD-MM-YYYY'
				},
			});
		});
	});
</script>

<script>
	$(function () {
		$("input.gotm_checkbox:checkbox").on('change', function() {
			$('input.gotm_checkbox:checkbox').not(this).prop('checked', false);
		});
	});
</script>

<!-- Stripe integration -->
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
	let stripe = StripeCheckout.configure({
		key: '{{ getStripePublishableKey() }}',
		image: '{{ asset('img/logo.png') }}',
		locale: 'auto',
		token: function (token) {
			var stripeEmail = $('#stripeEmail');
			var stripeToken = $('#stripeToken');
			stripeEmail.val(token.email);
			stripeToken.val(token.id);
			// submit the form
			var username = '{{ $user->username }}';
			var url = getUrl('/locals/@' + username + '/packages/store');
			var token = $('input[name="_token"]').val();
			var form = $('#profileForm');
			var data = form.serialize();

			// add loading class
			var packagesErrorEl = $('ul.packages-errors');
			packagesErrorEl.text('');
            $('#loading').removeClass('is-hidden');

			// fire ajax post request
			$.post(url, data)
			.done(function (response, textStatus) {
				var errors = response.errors;

				$('#loading').addClass('is-hidden');
                packagesErrorEl.removeClass('alert alert-danger');

				if (errors) {
					$('html, body').animate({
	                    scrollTop: (packagesErrorEl.offset().top - 30)
	                }, 1500);
				    //proveriti da li je greska u navodnicima !!!
				    if (typeof errors.ullalla_package !== 'undefined') {
				    	packagesErrorEl.addClass('alert alert-danger').text('{{ __('validation.default_package_required') }}');
				    } else if (typeof errors.ullalla_package_month_girl !== 'undefined') {
				    	packagesErrorEl.addClass('alert alert-danger').text('{{ __('validation.choose_package') }}');
				    } else {
				    	window.location.href = getUrl('/private/' + currentUser + '/packages');
				    }
				} else {
					window.location.href = getUrl("/locals/@" + username  + "/packages");
				}
			})
			.fail(function(data, textStatus) {
				$('#loading').addClass('is-hidden');
            	packagesErrorEl.addClass('alert alert-danger');

            	$('html, body').animate({
                    scrollTop: (packagesErrorEl.offset().top - 30)
                }, 1500);

            	console.log(data.responseJSON);

				packagesErrorEl.text(data.responseJSON.status);
			});
		}
	});

	@if (!$user->stripe_last4_digits && (!$user->is_active_d_package || !$user->is_active_gotm_package))
		$('#profileForm').on('submit', function (e) {
			var defaultPackageInput = document.querySelector('input[name="ullalla_package[]"]:checked');
			if (defaultPackageInput) {
				var packageId = defaultPackageInput.value;
			}
			if (packageId != 6) {
				stripe.open({
					name: 'Ullallà',
					description: '{{ $user->email }}',
				});
				e.preventDefault();
				$("[type='submit']").attr("disabled", false);
			} else {
				var username = '{{ $user->username }}';
				var url = getUrl('/locals/@' + username + '/packages/store');
				var token = $('input[name="_token"]').val();
				var form = $('#profileForm');
				var data = form.serialize();

				// add loading class
				var packagesErrorEl = $('ul.packages-errors');
				packagesErrorEl.text('');
	            $('#loading').removeClass('is-hidden');

				// fire ajax post request
				$.post(url, data)
					.done(function (data) {
						window.location.href = getUrl("/signin");
					})
					.fail(function(data, textStatus) {
						$('#loading').addClass('is-hidden');
		            	packagesErrorEl.addClass('alert alert-danger');

		            	$('html, body').animate({
		                    scrollTop: (packagesErrorEl.offset().top - 30)
		                }, 1500);

						packagesErrorEl.addClass('alert alert-danger').text(data.responseJSON.status);
					});
			}
		});
	@endif


	function hideLotm() {
		document.getElementById('lotm').style.display = "none";
	}
	function showLotm() {
		document.getElementById('lotm').style.display = "block";
	}
</script>
@stop