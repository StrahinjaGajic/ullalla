@if ($aboutToExpire !== null)
<p>{{ __('messages.email_gotm_expire_warning_package') }}:</p>
<a href="{{ url('@' . $user->username . '/packages') }}">{{ url('@' . $user->username . '/packages') }}</a>
@else
<p>{{ __('messages.email_gotm_expired_package') }}:</p>
<a href="{{ url('@' . $user->username . '/packages') }}">{{ url('@' . $user->username . '/packages') }}</a>
@endif