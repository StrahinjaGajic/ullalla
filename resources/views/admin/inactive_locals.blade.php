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
        <th>Username</th>
        <th>Name</th>
        <th>E-mail</th>
        <th colspan="3">Manage Locals</th>
        </thead>
        <tbody>
        @foreach($locals as $local)
        <tr>
            <td>{{ $local->username }}</td>
            <td>{{ $local->name }}</td>
            <td>{{ $local->email }}</td>
            <td>
                {!! Form::open(['url' => 'admin/inactive_locals/approve/' . $local->id]) !!}
                <button type="submit" class="btn">Approve</button>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop