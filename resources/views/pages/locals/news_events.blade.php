@extends('layouts.app')

@section('title', __('functions.news_and_events'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css?ver=' . str_random(10)) }}">
<link rel="stylesheet" href="{{ asset('css/components/girls.css?ver=' . str_random(10)) }}">
@stop

@section('content')
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditLocalProfileMenu('news_and_events') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<div class="col-xs-12">
				@if(Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
			</div><br><br>
			<div class="btn-wrapper">
				@if($local->news()->count() < 3)
				<button id="showModal" type="submit" class="btn btn-default">{{ __('buttons.news_entry') }}</button>
				@endif
				@if($local->events()->count() < 3)
				<button id="showModal2" type="submit" class="btn btn-default">{{ __('buttons.events_entry') }}</button>
				@endif
			</div>
			@if($local->news()->count() > 0)
			<div class="shop-layout headerDropdown">
				<div class="layout-title">
					<div class="layout-title toggle_arrow">
						<a>{{ __('headings.news') }} <i class="fa fa-caret-down"></i></a>
					</div>
				</div>
				<div class="layout-list">
					<div class="form-group girls_preview">
						<table class="table">
							<thead>
								<tr>
									<th>{{ __('fields.photo') }}</th>
									<th>{{ __('fields.title') }}</th>
									<th>{{ __('headings.activation_date') }}</th>
									<th>{{ __('headings.expiry_date') }}</th>
								</tr>
							</thead>
							<tbody id="prices_body">
								@foreach($local->news as $news)
								<tr>
									<td>
										@if ($news->news_photo)
										<div class="image-tooltip">
											<img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($news->news_photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='news image'/>
											<span>
												<img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($news->news_photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='news image'/>
											</span>
										</div>
										@endif
									</td>
									<td>{{ $news->news_title }}</td>
									<td>{{ date('d-m-Y', strtotime($news->news_activation_date)) }}</td>
									<td>{{ date('d-m-Y', strtotime($news->news_expiry_date)) }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>  
				</div>
			</div>
			@endif

			@if($local->events()->count() > 0)
			<div class="shop-layout headerDropdown">
				<div class="layout-title">
					<div class="layout-title toggle_arrow">
						<a>{{ __('headings.events') }} <i class="fa fa-caret-down"></i></a>
					</div>
				</div>
				<div class="layout-list">
					<div class="form-group girls_preview">
					<div style="overflow-x:auto;">
						<table class="table">
							<thead>
								<tr>
									<th>{{ __('fields.date') }}</th>
									<th>{{ __('fields.photo') }}</th>
									<th>{{ __('fields.title') }}</th>
									<th>{{ __('fields.venue') }}</th>
									<th>{{ __('headings.activation_date') }}</th>
									<th>{{ __('headings.expiry_date') }}</th>
								</tr>
							</thead>
							<tbody id="prices_body">
								@foreach($local->events as $event)
								<tr>
									<td>{{ date('d-m-Y', strtotime($event->events_date)) }}</td>
									<td>
										@if ($event->events_photo)
										<div class="image-tooltip">
											<img class='img-responsive img-align-center index-product-image' src='{{ app()->uploadcare->getFile($event->events_photo)->op('quality/best')->op('progressive/yes')->resize('', 50)->getUrl() }}' alt='event image'/>
											<span>
												<img class='img-responsive img-align-center' src='{{ app()->uploadcare->getFile($event->events_photo)->op('quality/best')->op('progressive/yes')->resize('', 150)->getUrl() }}' alt='event image'/>
											</span>
										</div>
										@endif
									</td>
									<td>{{ $event->events_title }}</td>
									<td>{{ $event->events_venue }}</td>
									<td>{{ date('d-m-Y', strtotime($event->events_activation_date)) }}</td>
									<td>{{ date('d-m-Y', strtotime($event->events_expiry_date)) }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
					</div>  
				</div>
			</div>
			@endif
		</div>
	</div>
</div>

<div class="wrapper section-create-profile">
	<!-- News modal -->
	<div id="news_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					{!! Form::open(['url' => 'locals/@' . $local->username . '/news/store', 'class' => 'form-horizontal wizard', 'id' => 'newsForm']) !!}
					<div class="col-xs-12">
						<div class="form-group">
							<label class="control control--checkbox"><a>{{ __('fields.prepared_flyer') }}</a>
								<input type="checkbox" name="news_flyer" class="prepared_flyer" {{ old('news_flyer') ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						</div>
						<div class="flyerless-fields">
							<div class="form-group {{ $errors->has('news_title') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.title') }}*</label>
								<input type="text" class="form-control" name="news_title" value="{{ old('news_title') }}" />
								<span class="help-block">{{ $errors->has('news_title') ? $errors->first('news_title') : '' }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('news_duration') ? 'has-error' : '' }}">
							<label class="control-label">{{ __('fields.duration') }}*</label>
							<input type="text" class="form-control events_duration" name="news_duration" value="{{ old('news_duration') }}"/>
							<input type="hidden" name="duration"/>
							<span class="help-block">{{ $errors->has('news_duration') ? $errors->first('news_duration') : '' }}</span>
						</div>
						<div class="flyerless-fields">
							<div class="form-group {{ $errors->has('news_description') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.description') }}*</label>
								<textarea name="news_description" cols="30" rows="10">{{ old('news_description') }}</textarea>
								<span class="help-block">{{ $errors->has('news_description') ? $errors->first('news_description') : '' }}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">{{ __('fields.price_per_day') }}</label>
							<input type="text" disabled="" class="form-control events_price" value="{{ number_format(getEventPrice(true), 2) }}">
							<span class="currency-holder">CHF</span>
						</div>
						<div class="form-group">
							<label class="control-label">{{ __('fields.total') }}</label>
							<input type="text" disabled="" class="form-control events_total" value="{{ number_format(getEventPrice(), 2) }}">
							<span class="currency-holder">CHF</span>
						</div>
						<div class="form-group {{ $errors->has('news_photo') ? 'has-error' : '' }}">
							<div class="image-preview-multiple">
								<input type="hidden" name="news_photo" data-crop="490x560 minimum" data-images-only="">
								<span class="help-block">{{ $errors->has('news_photo') ? $errors->first('news_photo') : '' }}</span>
							</div>
						</div>
						<button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
					</div>
					<input type="hidden" name="stripeTokenNews" id="stripeTokenNews">
					<input type="hidden" name="stripeEmailNews" id="stripeEmailNews">
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<!-- Events modal -->
	<div id="events_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					{!! Form::open(['url' => 'locals/@' . $local->username . '/events/store', 'class' => 'form-horizontal wizard', 'id' => 'eventForm']) !!}
					<div class="col-xs-12">
						<div class="form-group">
							<label class="control control--checkbox" style="margin-left:0px;"><a class="flyer">{{ __('fields.prepared_flyer') }}</a>
								<input type="checkbox" name="events_flyer" class="prepared_flyer" {{ old('events_flyer') ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						</div>
						<div class="flyerless-fields">
							<div class="form-group {{ $errors->has('events_title') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.title') }}*</label>
								<input type="text" class="form-control news_form_control" name="events_title" value="{{ old('events_title') }}" />
								<span class="help-block">{{ $errors->has('events_title') ? $errors->first('events_title') : '' }}</span>
							</div>
							<div class="form-group {{ $errors->has('events_venue') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.venue') }}*</label>
								<input type="text" class="form-control news_form_control" name="events_venue" value="{{ old('events_venue') }}"/>
								<span class="help-block">{{ $errors->has('events_venue') ? $errors->first('events_venue') : '' }}</span>
							</div>
							<div class="form-group {{ $errors->has('events_date') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.date') }}*</label>
								<input type="text" class="form-control news_form_control" name="events_date" value="{{ old('events_date') }}"/>
								<span class="help-block">{{ $errors->has('events_date') ? $errors->first('events_date') : '' }}</span>
							</div>
						</div>
						<div class="form-group {{ $errors->has('events_duration') ? 'has-error' : '' }}">
							<label class="control-label">{{ __('fields.duration') }}*</label>
							<input type="text" class="form-control events_duration news_form_control" name="events_duration" value=""/>
							<input type="hidden" name="duration"/>
							<span class="help-block">{{ $errors->has('events_duration') ? $errors->first('events_duration') : '' }}</span>
						</div>
						<div class="flyerless-fields">
							<div class="form-group {{ $errors->has('events_description') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.description') }}*</label>
								<textarea class="news_textarea" name="events_description" cols="30" rows="10">{{ old('events_description') }}</textarea>
								<span class="help-block">{{ $errors->has('events_description') ? $errors->first('events_description') : '' }}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">{{ __('fields.price_per_day') }}</label>
							<input type="text" disabled="" class="form-control events_price news_disabled news_form_control" value="{{ number_format(getEventPrice(true), 2) }}">
							<span class="currency-holder">CHF</span>
						</div>
						<div class="form-group">
							<label class="control-label">{{ __('fields.total') }}</label>
							<input type="text" disabled="" class="form-control events_total news_disabled news_form_control" value="{{ number_format(getEventPrice(), 2) }}">
							<span class="currency-holder">CHF</span>
						</div>
						<div class="form-group {{ $errors->has('events_photo') ? 'has-error' : '' }}">
							<div class="image-preview-multiple">
								<input type="hidden" name="events_photo" data-crop="490x560 minimum" data-images-only="">
								
								<button type="submit" style="margin-top:0px;" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
								<span class="help-block">{{ $errors->has('events_photo') ? $errors->first('events_photo') : '' }}</span>
							</div>
							
						</div>
						
					</div>
					<input type="hidden" name="stripeTokenEvent" id="stripeTokenEvent">
					<input type="hidden" name="stripeEmailEvent" id="stripeEmailEvent">
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('perPageScripts')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>


@if(Session::has('showNewsModal'))
<script>
	$('#news_modal').modal('show');
</script>
@endif

@if(Session::has('showEventsModal'))
<script>
	$('#events_modal').modal('show');
</script>
@endif

<script>
    ////////// 1. MODAL, DATERANGE PICKER, ////////
    $("#showModal").on('click',function(){
    	$('#news_modal').modal('show');
    });
    $("#showModal2").on('click',function(){
    	$('#events_modal').modal('show');
    });

    $(function () {
    	var start = moment(new Date()).format('DD/MM/YYYY H:mm');
    	var end = moment(start, 'DD/MM/YYYY H:mm').add('1', 'years').format('DD/MM/YYYY H:mm');

    	$('input[name="events_duration"]').daterangepicker({
    		minDate: start,
    		maxDate: end,
    		locale: {
    			format: 'DD/MM/YYYY'
    		}
    	});

    	$('input[name="events_date"]').daterangepicker({
    		timePicker: true,
    		timePicker24Hour: true,
    		timePickerIncrement: 15,
    		minDate: start,
    		maxDate: end,
    		locale: {
    			format: 'DD/MM/YYYY H:mm'
    		}
    	});

    	$('input[name="news_duration"]').daterangepicker({
    		minDate: start,
    		maxDate: end,
    		locale: {
    			format: 'DD/MM/YYYY'
    		}
    	});
    });

    ////////// 2. UPLOAD CARE ////////
    function minDimensions(width, height) {
    	return function(fileInfo) {
    		var imageInfo = fileInfo.originalImageInfo;
    		if (imageInfo !== null) {
    			if (imageInfo.width < width || imageInfo.height < height) {
    				throw new Error('{{ __('messages.dimensions') }}');
    			}
    		}
    	};
    }

    function maxFileSize(size) {
    	return function (fileInfo) {
    		if (fileInfo.size !== null && fileInfo.size > size) {
    			throw new Error('{{ __('messages.file_maximum_size') }}');
    		}
    	}
    }

    $(function() {
    	const eventWidget = uploadcare.Widget('[name=events_photo]')
    	const newsWidget = uploadcare.Widget('[name=news_photo]')
    	eventWidget.validators.push(minDimensions(490, 560));
    	eventWidget.validators.push(maxFileSize(20000000));
    	newsWidget.validators.push(minDimensions(490, 560));
    	newsWidget.validators.push(maxFileSize(20000000));
    });

</script>

<script>
	$(".toggle_arrow").on("click", function() {
		var that = $(this);
		that.closest('.shop-layout').find('.layout-list').toggle('fast');
		that.parent().find(".fa-caret-down").toggleClass("rotateCaretBack");
	});
</script>

<script>
	var tooltips = document.querySelectorAll('.image-tooltip span');
	window.onmousemove = function (e) {
		var x = (e.clientX + 20) + 'px',
		y = (e.clientY + 20) + 'px';
		for (var i = 0; i < tooltips.length; i++) {
			tooltips[i].style.top = y;
			tooltips[i].style.left = x;
		}
	};
</script>

<script>
	var eventPricePerDay = parseFloat('{{ getEventPrice(true) }}');
	var eventPrice = parseFloat('{{ getEventPrice() }}');

	$('.prepared_flyer').on('click', function () {
		var modalBody = $(this).closest('.modal-body');
		var flyerlessDiv = modalBody.find('.flyerless-fields');
		var totalEl = modalBody.find('.events_total');

		flyerlessDiv.toggle();

		var diffInDays = parseFloat(modalBody.find('input[name="duration"]').val());

		if (flyerlessDiv.is(':hidden')) {
			var flyerlessEventPrice = parseFloat('{{ getEventPrice(false, false) }}');

			if (diffInDays > 0) {
				var totalWithFlyer = flyerlessEventPrice + (eventPricePerDay * diffInDays);
				totalEl.val(totalWithFlyer.toFixed(2));
			} else {
				totalEl.val(flyerlessEventPrice.toFixed(2));
			}

		} else {
			var eventPrice = parseFloat('{{ getEventPrice(false, true) }}');

			if (diffInDays > 0) {
				var totalWithoutFlyer = eventPrice + (eventPricePerDay * diffInDays);
				totalEl.val(totalWithoutFlyer.toFixed(2));
			} else {
				totalEl.val(eventPrice.toFixed(2));
			}
		}
	});

	$('.events_duration').on('change', function () {
		var that = $(this);
		var thatVal = that.val();
		var modalBody = that.closest('.modal-body');
		var totalEl = modalBody.find('.events_total');
		var flyerlessDiv = modalBody.find('.flyerless-fields');

		var exploadedThatVal = thatVal.split(' - ');
		var from = moment(exploadedThatVal[0], 'DD/MM/YYYY');
		var to = moment(exploadedThatVal[1], 'DD/MM/YYYY');
		var diffInDays = to.diff(from, 'days');

		var total = eventPrice + (eventPricePerDay * diffInDays);
		totalEl.val(total.toFixed(2));
		that.next().val(diffInDays);

		if (!modalBody.is(':hidden')) {
			if (flyerlessDiv.is(':hidden')) {
				var flyerlessEventPrice = parseFloat('{{ getEventPrice(false, false) }}');
				if (diffInDays > 0) {
					var totalWithFlyer = flyerlessEventPrice + (eventPricePerDay * diffInDays);
					totalEl.val(totalWithFlyer.toFixed(2));
				} else {
					totalEl.val(flyerlessEventPrice.toFixed(2));
				}
			} else {
				var eventPrice = parseFloat('{{ getEventPrice(false, true) }}');
				if (diffInDays > 0) {
					var totalWithoutFlyer = eventPrice + (eventPricePerDay * diffInDays);
					totalEl.val(totalWithoutFlyer.toFixed(2));
				} else {
					totalEl.val(eventPrice.toFixed(2));
				}
			}
		} else {
			totalEl.val(parseFloat('{{ getEventPrice(false, true) }}').toFixed(2));
		}
	});
</script>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
	let stripeNews = StripeCheckout.configure({
		key: '{{ getStripePublishableKey() }}',
		image: '{{ asset('img/logo.png') }}',
		locale: 'auto',
		token: function (token) {
			var stripeEmail = $('#stripeEmailNews');
			var stripeToken = $('#stripeTokenNews');
			stripeEmail.val(token.email);
			stripeToken.val(token.id);
			// submit the form
			var username = '{{ $local->username }}';
			var url = getUrl('/locals/@' + username + '/news/store');
			var form = $('#newsForm');
			var token = form.find('input[name="_token"]').val();
			var data = form.serialize();
			// fire ajax post request
			$.post(url, data)
			.done(function (data) {
				var errors = data.errors;
				$('.form-group').removeClass('has-error');
				$('.help-block').text('');
				if (errors) {
					$.each(errors, function (index, value) {
						var errorField = $('[name="' + index + '"]');
						errorField.siblings('.help-block').text(value);
						errorField.closest('.form-group').addClass('has-error');
					});
				} else {
					window.location.href = getUrl('/locals/@' + username + '/news_and_events');
				}
			})
			.fail(function(data, textStatus) {
				$('.default-packages-section').find('.help-block').text(data.responseJSON.status);
			});
		}
	});
	$('#newsForm').on('submit', function (e) {
		stripeNews.open({
			name: 'Ullallà',
			description: '{{ $local->email }}',
		});
		e.preventDefault();
		$("[type='submit']").attr("disabled", false);
	});
</script>

<script>
	let stripeEvent = StripeCheckout.configure({
		key: '{{ getStripePublishableKey() }}',
		image: '{{ asset('img/logo.png') }}',
		locale: 'auto',
		token: function (token) {
			var stripeEmail = $('#stripeEmailEvent');
			var stripeToken = $('#stripeTokenEvent');
			stripeEmail.val(token.email);
			stripeToken.val(token.id);
			// submit the form
			var username = '{{ $local->username }}';
			var url = getUrl('/locals/@' + username + '/events/store');
			var form = $('#eventForm');
			var token = form.find('input[name="_token"]').val();
			var data = form.serialize();
			// fire ajax post request
			$.post(url, data)
			.done(function (data) {
				var errors = data.errors;
				$('.form-group').removeClass('has-error');
				$('.help-block').text('');
				if (errors) {
					$.each(errors, function (index, value) {
						var errorField = $('[name="' + index + '"]');
						errorField.siblings('.help-block').text(value);
						errorField.closest('.form-group').addClass('has-error');
					});
				} else {
					window.location.href = getUrl('/locals/@' + username + '/news_and_events');
				}
			})
			.fail(function(data, textStatus) {
				$('.default-packages-section').find('.help-block').text(data.responseJSON.status);
			});
		}
	});
	$('#eventForm').on('submit', function (e) {
		stripeEvent.open({
			name: 'Ullallà',
			description: '{{ $local->email }}',
		});
		e.preventDefault();
		$("[type='submit']").attr("disabled", false);
	});
</script>
@stop