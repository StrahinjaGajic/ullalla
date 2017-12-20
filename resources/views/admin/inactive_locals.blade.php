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
        <th>{{ __('labels.username') }}</th>
        <th>{{ __('labels.name') }}</th>
        <th>{{ __('labels.email') }}</th>
        <th colspan="3">{{ __('global.manage_locals') }}</th>
        </thead>
        <tbody>
        @foreach($locals as $local)
        <tr>
            <td>{{ $local->username }}</td>
            <td>{{ $local->name }}</td>
            <td>{{ $local->email }}</td>
            <td>
                {!! Form::open(['url' => 'admin/inactive_locals/approve/' . $local->id]) !!}
                <button type="submit" class="btn">{{ __('buttons.approve') }}</button>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop