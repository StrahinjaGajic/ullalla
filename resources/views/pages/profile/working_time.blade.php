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
			{!! parseEditProfileMenu('working_time') !!}
		</div>
		<div class="col-sm-10 profile-info">
			<h3>Personal info</h3>
			{!! Form::model($user, ['url' => '@' . $user->username . '/working_time/store', 'method' => 'put']) !!}
			<div class="row">
				<div class="col-sm-12">
					<?php 
					$counter = 1;
					$workingTime = isJson($user->working_time) ? json_decode($user->working_time) : $user->working_time;
					?>
					<div class="form-group">
						<div id="available_24_7">
							<label class="control control--checkbox"><a>Available 24/7</a>
								<input type="checkbox" name="available_24_7" {{ stringHasString('Available 24/7', $workingTime) ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
							<label class="control control--checkbox {{ !stringHasString('Available 24/7', $workingTime) ? 'working-times-disabled' : '' }}"><a>Show As Night Escort</a>
								<input type="checkbox" name="available_24_7_night_escort" value="1" {{ !stringHasString('Available 24/7', $workingTime) ? 'disabled' : '' }} {{ stringHasString('&', $workingTime) ? 'checked' : '' }}>
								<div class="control__indicator"></div>
							</label>
						</div>
						<table class="table working-times-table">
							<thead>
								<tr>
									<th>
										<label class="control control--checkbox"><a>Mark All</a>
											<input type="checkbox" id="select_all_days" {{ count($workingTime) == 7 ? 'checked' : '' }}>
											<div class="control__indicator"></div>
										</label>
									</th>
									<th>From</th>
									<th>To</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach(getDaysOfTheWeek() as $dayOfTheWeek)
								<?php $dbDayOfTheWeek = stripos($user->working_time, $dayOfTheWeek) !== false ? $dayOfTheWeek : ''; ?>
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
										<span>hrs</span>
										<select name="time_from_m[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getMinutesList() as $minute)
											<option value="{{ $minute }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[0])[1] == $minute) ? 'selected' : '' }}>{{ $minute }}</option>
											@endforeach
										</select>
										<span>min</span>
									</td>
									<td>
										<select name="time_to[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getHoursList() as $hour)
											<option value="{{ $hour }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[1])[0] == $hour) ? 'selected' : '' }}>{{ $hour }}</option>
											@endforeach
										</select>
										<span>hrs</span>
										<select name="time_to_m[{{ $counter }}]" class="form-control" {{ !$dbDayOfTheWeek ? 'disabled' : '' }}>
											@foreach(getMinutesList() as $minute)
											<option value="{{ $minute }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode(':', explode(' - ', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1])[1])[1] == $minute) ? 'selected' : '' }}>{{ $minute }}</option>
											@endforeach
										</select>
										<span>min</span>
									</td>
									<td>
										<label class="control control--checkbox"><a>Night Escort</a>
											<input type="checkbox" name="night_escorts[{{ $counter }}]" value="{{ $counter }}" {{ ($dbDayOfTheWeek == $dayOfTheWeek) && (explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))) ? '' : 'disabled' }} {{ ($dbDayOfTheWeek == $dayOfTheWeek) && stringHasString('&', explode('|', arrayHasString($workingTime, $dbDayOfTheWeek))[1]) ? 'checked' : '' }}>
											<div class="control__indicator"></div>
										</label>
									</td>
								</tr>
								<?php $counter++; ?>
								@endforeach
							</tbody>
						</table>
						<button type="submit" class="btn btn-default">Save Changes</button>
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

</script>
@stop