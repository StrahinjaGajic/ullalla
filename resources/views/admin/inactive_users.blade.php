@extends('layouts.admin')

@section('content')
<div class="container">
	@if (Session::has('success'))
		<div class="alert alert-success">
			{{ Session::get('success') }}
		</div>
	@endif
	@if (Session::has('error'))
		<div class="alert alert-danger">
			{{ Session::get('error') }}
		</div>
	@endif
	<table>
		<thead>
			<th>{{ __('labels.name') }}</th>
			<th>{{ __('labels.surname') }}</th>
			<th>{{ __('fields.nickname') }}</th>
			<th colspan="3">{{ __('labels.manage_user') }}</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->last_name }}</td>
					<td>{{ $user->nickname }}</td>
					<td>
						{!! Form::open(['url' => 'admin/inactive_users/approve/' . $user->id]) !!}
						<button type="submit" class="btn">{{ __('buttons.approve') }}</button>
						{!! Form::close() !!}
					</td>
					<td>
						{!! Form::open() !!}
						<button type="submit" class="btn"></button>
						{!! Form::close() !!}
					</td>
					<td>
						{!! Form::open() !!}
						<button type="submit" class="btn"></button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop