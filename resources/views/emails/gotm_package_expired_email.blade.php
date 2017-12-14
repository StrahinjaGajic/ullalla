@if ($aboutToExpire !== null)
<p>Your Girl of The Month package is about to expire. In order to renew your package please click on the following link:</p>
<a href="{{ url('@' . $user->username . '/packages') }}">{{ url('@' . $user->username . '/packages') }}</a>
@else
<p>Your Girl of The Month package has expired. In order to renew your package please click on the following link:</p>
<a href="{{ url('@' . $user->username . '/packages') }}">{{ url('@' . $user->username . '/packages') }}</a>
@endif