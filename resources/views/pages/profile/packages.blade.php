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
			{!! parseEditProfileMenu('packages') !!}
		</div>
		<?php $counter = 1; ?>
		<div class="col-sm-10 profile-info">
			<div class="col-xs-12">
				@if(Session::has('success_gotm_scheduled'))
					<div class="alert alert-success">{{ Session::get('success_gotm_scheduled') }}</div>
				@endif
				@if(Session::has('success_d_scheduled'))
					<div class="alert alert-success">{{ Session::get('success_d_scheduled') }}</div>
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
									@if($user->sex == 'transsexual')
										<td>{{ __('headings.totm_package') }}</td>
									@else
										<td>{{ __('headings.gotm_package') }}</td>
									@endif
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
									<td>{{ date('d-m-Y', strtotime($scheduledDefaultPackage[1])) }}</td>
									<td>{{ date('d-m-Y', strtotime($scheduledDefaultPackage[2])) }}</td>
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
									<td>{{ date('d-m-Y', strtotime($scheduledGotmPackage[1])) }}</td>
									<td>{{ date('d-m-Y', strtotime($scheduledGotmPackage[2])) }}</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			@endif

			@if($showDefaultPackages || $showGotmPackages)
				{!! Form::model($user, ['url' => 'private/' . $user->id . '/packages/store', 'id' => 'profileForm', 'method' => 'PUT']) !!}

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
									<td class="text-center">{{ $package->package_name }}</td>
									<td class="text-center">{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
									<td class="text-center">
										@if(explode(',', $package->package_discount)[0] && explode(',', $package->package_discount)[0] != 0)
											<span id="price_{{ $package->id }}" style="text-decoration:line-through; font-size:12px">{{ $package->package_price }} CHF</span>
										@else
											<span id="price_{{ $package->id }}">{{ $package->package_price }} CHF</span>
										@endif
										@if(explode(',', $package->package_discount)[0] && explode(',', $package->package_discount)[0] != 0)
										<p>
											<span style="color:#f26522;">{{ explode(',', $package->package_discount)[0] }}%</span> |
											<span style="font-weight: bold;">{{ callTotalPackagePrice($package->package_price, $package->package_discount, 0) }} CHF</span>
										</p>
										@endif
									</td>
									<td class="text-center">
										<input type="text" name="default_package_activation_date[{{ $package->id }}]" class="package_activation" id="package_activation{{ $counter }}">
									</td>
									<td class="text-center">
										<label class="control control--checkbox">
											<input type="radio" name="ullalla_package[]" value="{{ $package->id }}" />
											<div class="control__indicator"></div>
										</label>
									</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</tbody>
						</table>
						@if(!$showGotmPackages)
							<button type="submit" class="btn btn-default">{{ __('buttons.pay_now') }}</button>
						@endif
					</div>
				@endif

				@if($showGotmPackages)
					<div class="col-xs-12">
						@if($user->sex == 'transsexual')
							<h3>{{ __('headings.totm_package') }}</h3>
						@else
							<h3>{{ __('headings.gotm_package') }}</h3>
						@endif
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
								@foreach ($packages->take(3) as $package)
								<tr>
									<td class="text-center">{{ $package->package_name }}</td>
									<td class="text-center">{{ $package->package_duration }} {{ trans_choice('fields.days', 2) }}</td>
									<td class="text-center">
										@if(explode(',', $package->package_discount)[1] && explode(',', $package->package_discount)[1] != 0)
											<span id="price_{{ $package->id }}" style="text-decoration:line-through; font-size:12px">{{ $package->package_price }} CHF</span>
										@else
											<span id="price_{{ $package->id }}">{{ $package->package_price }} CHF</span>
										@endif
										@if(explode(',', $package->package_discount)[1] && explode(',', $package->package_discount)[1] != 0)
											<p>
												<span style="color:#f26522;">{{ explode(',', $package->package_discount)[1] }}%</span> |
												<span style="font-weight: bold;">{{ callTotalPackagePrice($package->package_price, $package->package_discount, 1) }} CHF</span>
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
						<div class="save">
							<button type="submit" class="btn btn-default">{{ __('buttons.pay_now') }}</button>
						</div>
					</div>
				@endif
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
		'error'
		);
	</script>
	@endif
	<script>
	// get new start and end year
	var start = new Date();
	start.setFullYear(start.getFullYear());
	var end = new Date();
	end.setFullYear(end.getFullYear() + 1);

	var package1ExpiryDate = '{{ $user->package1_expiry_date }}';
	var package2ExpiryDate = '{{ $user->package2_expiry_date }}';

	var defaultPackageStartDate = package1ExpiryDate != '' ? JSON.parse('{!! json_encode([$user->package1_expiry_date]) !!}') : start;
	var defaultPackageStartDate = package1ExpiryDate != '' ? new Date(defaultPackageStartDate[0].date) : defaultPackageStartDate;
	var defaultPackageStartDate = new Date() > defaultPackageStartDate ? new Date() : defaultPackageStartDate;

	var gotmPackageStartDate = package2ExpiryDate != '' ? JSON.parse('{!! json_encode([$user->package2_expiry_date]) !!}') : start;
	var gotmPackageStartDate = package2ExpiryDate != '' ? new Date(gotmPackageStartDate[0].date) : gotmPackageStartDate;
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
			var currentUser = '{{ $user->id }}';
			var url = getUrl('/private/' + currentUser + '/packages/store');
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
					window.location.href = getUrl('/private/' + currentUser + '/packages');
				}
			})

			.fail(function(data, textStatus) {
				$('#loading').addClass('is-hidden');
            	packagesErrorEl.addClass('alert alert-danger');

            	$('html, body').animate({
                    scrollTop: (packagesErrorEl.offset().top - 30)
                }, 1500);

                console.log('asdas');

				packagesErrorEl.addClass('alert alert-danger').text(data.responseJSON.status);
			});
		}
	});
	@if(!$user->stripe_last4_digits)
		$('#profileForm').on('submit', function (e) {
			stripe.open({
				name: 'Ullallà',
				description: '{{ $user->email }}',
			});
			e.preventDefault();
			$("[type='submit']").attr("disabled", false);
		});
	@endif
</script>
@stop