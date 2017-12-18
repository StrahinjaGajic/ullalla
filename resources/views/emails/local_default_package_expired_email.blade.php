@if ($aboutToExpire !== null)
    <p>Your Default Package is about to expire. In order to renew your package please click on the following link:</p>
    <a href="{{ url('locals/@' . $user->username . '/packages') }}">{{ url('locals/@' . $user->username . '/packages') }}</a>
@else
    <p>Your Default Package has expired. In order to renew your package please click on the following link:</p>
    <a href="{{ url('locals/@' . $user->username . '/packages') }}">{{ url('local/@' . $user->username . '/packages') }}</a>
@endif