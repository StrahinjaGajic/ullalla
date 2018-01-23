@extends('layouts.app')

@section('title', __('functions.news_and_events'))

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
<link rel="stylesheet" href="{{ url('css/components/girls.css') }}">
@stop

@section('content')
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditLocalProfileMenu('news_and_events') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<div class="btn-wrapper">
				<button id="showModal" type="submit" class="btn btn-default">{{ __('buttons.news_entry') }}</button>
				<button id="showModal2" type="submit" class="btn btn-default">{{ __('buttons.events_entry') }}</button>
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
									<th>{{ __('fields.date') }}</th>
									<th>{{ __('fields.photo') }}</th>
									<th>{{ __('fields.title') }}</th>
									<th>{{ __('fields.duration') }}</th>
									<th>{{ __('headings.expiry_date') }}</th>
								</tr>
							</thead>
							<tbody id="prices_body">
								@foreach($local->news as $news)
								<tr>
									<td>{{ date('d-m-Y', strtotime($news->date)) }}</td>
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
									<td>{{ $news->news_duration }}</td>
									<td>{{ $news->news_duration }}</td>
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
						<table class="table">
							<thead>
								<tr>
									<th>{{ __('fields.date') }}</th>
									<th>{{ __('fields.photo') }}</th>
									<th>{{ __('fields.title') }}</th>
									<th>{{ __('fields.venue') }}</th>
									<th>{{ __('fields.duration') }}</th>
									<th>{{ __('headings.expiry_date') }}</th>
								</tr>
							</thead>
							<tbody id="prices_body">
								@foreach($local->events as $event)
								<tr>
									<td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
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
									<td>{{ $event->events_duration }}</td>
									<td>{{ $event->events_duration }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
					{!! Form::open(['url' => 'locals/@' . $local->username . '/news/store', 'class' => 'form-horizontal wizard']) !!}
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
								@if ($errors->has('news_title'))
								<span class="help-block">{{ $errors->first('news_title') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('news_duration') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.duration') }}*</label>
								<input type="text" class="form-control" name="news_duration" value="{{ old('news_duration') }}"/>
								@if ($errors->has('news_duration'))
								<span class="help-block">{{ $errors->first('news_duration') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('news_description') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.description') }}*</label>
								<textarea name="news_description" cols="30" rows="10">{{ old('news_description') }}</textarea>
								@if ($errors->has('news_description'))
								<span class="help-block">{{ $errors->first('news_description') }}</span>
								@endif
							</div>
						</div>
						<div class="form-group {{ $errors->has('news_photo') ? 'has-error' : '' }}">
							<div class="image-preview-multiple">
								<input type="hidden" name="news_photo" data-crop="490x560 minimum" data-images-only="">
								@if ($errors->has('news_photo'))
								<span class="help-block">{{ $errors->first('news_photo') }}</span>
								@endif
							</div>
						</div>
						<button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
					</div>
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
					{!! Form::open(['url' => 'locals/@' . $local->username . '/events/store', 'class' => 'form-horizontal wizard']) !!}
					<div class="col-xs-12">
						<div class="form-group">
							<label class="control control--checkbox"><a>{{ __('fields.prepared_flyer') }}</a>
								<input type="checkbox" name="events_flyer" class="prepared_flyer" {{ old('events_flyer') ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						</div>
						<div class="flyerless-fields">
							<div class="form-group {{ $errors->has('events_title') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.title') }}*</label>
								<input type="text" class="form-control" name="events_title" value="{{ old('events_title') }}" />
								@if ($errors->has('events_title'))
								<span class="help-block">{{ $errors->first('events_title') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('events_venue') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.venue') }}*</label>
								<input type="text" class="form-control" name="events_venue" value="{{ old('events_venue') }}"/>
								@if ($errors->has('events_venue'))
								<span class="help-block">{{ $errors->first('events_venue') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('events_date') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.date') }}*</label>
								<input type="text" class="form-control" name="events_date" value="{{ old('events_date') }}"/>
								@if ($errors->has('events_date'))
								<span class="help-block">{{ $errors->first('events_date') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('events_duration') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.duration') }}*</label>
								<input type="text" class="form-control" name="events_duration" value="{{ old('events_duration') }}"/>
								@if ($errors->has('events_duration'))
								<span class="help-block">{{ $errors->first('events_duration') }}</span>
								@endif
							</div>
							<div class="form-group {{ $errors->has('events_description') ? 'has-error' : '' }}">
								<label class="control-label">{{ __('fields.description') }}*</label>
								<textarea name="events_description" cols="30" rows="10">{{ old('events_description') }}</textarea>
								@if ($errors->has('events_description'))
								<span class="help-block">{{ $errors->first('events_description') }}</span>
								@endif
							</div>
						</div>
						<div class="form-group {{ $errors->has('events_photo') ? 'has-error' : '' }}">
							<div class="image-preview-multiple">
								<input type="hidden" name="events_photo" data-crop="490x560 minimum" data-images-only="">
								@if ($errors->has('events_photo'))
								<span class="help-block">{{ $errors->first('events_photo') }}</span>
								@endif
							</div>
						</div>
						<button type="submit" class="btn btn-default pull-right">{{ __('buttons.submit') }}</button>
					</div>
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
    	var start = new Date();
    	start.setFullYear(start.getFullYear());
    	var end = new Date();
    	end.setFullYear(end.getFullYear() + 1);

    	$('input[name="events_duration"]').daterangepicker({
    		minDate: start,
    		locale: {
    			format: 'DD/MM/YYYY'
    		}
    	});

    	$('input[name="events_date"]').daterangepicker({
    		timePicker: true,
    		timePicker24Hour: true,
    		timePickerIncrement: 15,
    		minDate: start,
    		locale: {
    			format: 'DD/MM/YYYY H:mm'
    		}
    	});

    	$('input[name="news_duration"]').daterangepicker({
    		minDate: start,
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
<script type="text/javascript">
	var requiredField = '{{ __('validation.required_field') }}';
	var alphaNumeric = '{{ __('validation.alpha_numerical') }}';
	var olderThan = '{{ __('validation.older_than_18') }}';
	var stringLength = '{{ __('validation.string_length') }}';
	var numericError = '{{ __('validation.numeric_error') }}';
	var invalidUrl = '{{ __('validation.url_invalid') }}';
	var defaultPackageRequired = '{{ __('validation.default_package_required') }}';
	var maxFiles = '{{ __('validation.max_files') }}';
</script>

<script>
	$('.control__indicator').on('click', function () {
		window.location.href = $(this).closest('label').find('a').attr('href');
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
	$('.prepared_flyer').on('click', function () {
		$(this).closest('.modal-body').find('.flyerless-fields').toggle();
	});
</script>
@stop