@extends('layouts.app')

@section('title', 'Working Time')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/components/edit_profile.css') }}">
@stop

@section('content')
<div class="shop-header-banner">
	<span><img src="img/banner/profil-banner.jpg" alt=""></span>
</div>
<div class="container theme-cactus">
	<div class="row">
		<div class="col-sm-2 vertical-menu">
			{!! parseEditLocalProfileMenu('working_time') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<h3>{{ __('headings.working_time') }}</h3>
			{!! Form::model($local, ['url' => 'locals/@' . $local->username . '/working_time/store', 'method' => 'put']) !!}
			<div class="row">
				<div class="col-sm-12">
					<?php 
					$counter = 1;
					$workingTime = isJson($local->working_time) ? json_decode($local->working_time) : $local->working_time;
					?>
					<div class="form-group">
						<div id="available_24_7" class="pull-left">                    {{--PROVERITI AVAILABLE 24/7,MOGUCE DA JE VREDNOST IZ BAZE--}}
							<label class="control control--checkbox"><a>{{ __('labels.available_24_7') }}</a>
								<input type="checkbox" name="available_24_7" {{ stringHasString('Available 24/7', $workingTime) ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						</div>
						<div class="pull-right">
                            <button class="btn btn-default" id="apply_to_all">{{ __('labels.apply_to_all') }}</button>
                        </div>
						<table class="table working-times-table">
							<thead>
								<tr>
									<th>
										<label class="control control--checkbox"><a>{{ __('labels.mark_all') }}</a>
											<input type="checkbox" id="select_all_days" {{ count($workingTime) == 7 ? 'checked' : '' }}>
											<div class="control__indicator"></div>
										</label>
									</th>
									<th>{{ __('buttons.from') }}</th>
									<th>{{ __('buttons.to') }}</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach(getDaysOfTheWeek() as $dayOfTheWeek)
								<?php $dbDayOfTheWeek = stripos($local->working_time, $dayOfTheWeek) !== false ? $dayOfTheWeek : ''; ?>
								<tr class="{{ !$dbDayOfTheWeek ? 'working-times-disabled' : '' }}">
									<td>
										<label class="control control--checkbox"><a>{{ $dayOfTheWeek }}</a>
											<input type="checkbox" name="days[{{ $counter }}]" value="{{ $dayOfTheWeek }}" {{ $dbDayOfTheWeek ? 'checked' : '' }}>
											<div class="control__indicator"></div>
										</label>
									</td>
									<td>
										<select name="time_from[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getHoursList() as $hour)
											<option value="{{ $hour }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[0])[0] == $hour) ? 'selected' : '' }}>{{ $hour }}</option>
											@endforeach
										</select>
										<span>{{ __('global.hrs') }}</span>
										<select name="time_from_m[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getMinutesList() as $minute)
											<option value="{{ $minute }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[0])[1] == $minute) ? 'selected' : '' }}>{{ $minute }}</option>
											@endforeach
										</select>
										<span>{{ __('global.min') }}</span>
									</td>
									<td>
										<select name="time_to[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getHoursList() as $hour)
											<option value="{{ $hour }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[1])[0] == $hour) ? 'selected' : '' }}>{{ $hour }}</option>
											@endforeach
										</select>
										<span>{{ __('global.hrs') }}</span>
										<select name="time_to_m[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getMinutesList() as $minute)
											<option value="{{ $minute }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[1])[1] == $minute) ? 'selected' : '' }}>{{ $minute }}</option>
											@endforeach
										</select>
										<span>{{ __('global.min') }}</span>
									</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</tbody>
						</table>
						<button type="submit" class="btn btn-default">{{ __('buttons.save_changes') }}</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
@section('perPageScripts')
<script>
	$(function () {
		var selectAllDays = $('#select_all_days');
		var workingTimesRows = $('table.working-times-table').find('tr');
		var workingTimesBodyRows = $('table.working-times-table tbody').find('tr');

		$('.working-times-table tr td:first-child input').on('click', function () {
			var that = $(this);
			var closestTr = that.closest('tr');
			if (closestTr.hasClass('working-times-disabled')) {
				closestTr.removeClass('working-times-disabled');
				closestTr.find('select, input').attr('disabled', false);
			} else {
				closestTr.addClass('working-times-disabled');
				closestTr.find('select, td:last-child input').attr('disabled', true);
				closestTr.find('input').prop('checked', false);
			}
		});

		$(window).on('load', function () {
			if ($('#available_24_7 input').prop('checked')) {
				$('table.working-times-table').addClass('working-times-disabled').find('select, input').attr('disabled', true);
			}
		});

		$('#available_24_7 label:first-child input').on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				that.closest('label')
				.next('label')
				.removeClass('working-times-disabled')
				.find('input')
				.attr('disabled', false);
				$('table.working-times-table').addClass('working-times-disabled').find('select, input').attr('disabled', true);
			} else {
				that.closest('label')
				.next('label')
				.addClass('working-times-disabled')
				.find('input')
				.attr('disabled', true)
				.prop('checked', false);

				selectAllDays.attr('disabled', false);
				$('table.working-times-table').removeClass('working-times-disabled');		
				$('table.working-times-table').find('input').attr('disabled', false);
				workingTimesBodyRows.each(function () {
					if (!$(this).hasClass('working-times-disabled')) {
						$(this).find('select').attr('disabled', false);
					}
				});
			}
		});

		selectAllDays.on('click', function () {
			var that = $(this);
			if (that.prop('checked')) {
				// $('#available_24_7').addClass('working-times-disabled').find('input').attr('disabled', true).prop('checked',);
				that.closest('table').removeClass('working-times-disabled').find('tr').removeClass('working-times-disabled');
				that.closest('table').find('select, input').attr('disabled', false).prop('checked', true);
			} else {
				$('#available_24_7').removeClass('working-times-disabled').find('label:first-child input').attr('disabled', false);
				that.attr('disabled', false).closest('tr').removeClass('working-times-disabled');
				workingTimesBodyRows.addClass('working-times-disabled').find('select').attr('disabled', true).prop('checked', false);
				workingTimesBodyRows.find('input').attr('disabled', false).prop('checked', false);
			}
		});

	});

	$('#apply_to_all').on('click', function (e) {
		e.preventDefault();
		var workingTimesTable = $('.working-times-table');
		var firstRow = workingTimesTable.find('tbody tr:first-child');
		var rows = workingTimesTable.find('tbody tr');
		var fromHrs = firstRow.find('select[name="time_from[1]"]').val();
		var fromMin = firstRow.find('select[name="time_from_m[1]"]').val();
		
		$.each(rows, function () {
			
		}):
	});
</script>
@stop