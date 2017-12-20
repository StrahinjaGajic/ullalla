@if ($aboutToExpire !== null)
    <p>{{ __('messages.email_expire_warning_package') }}:</p>
    <a href="{{ url('locals/@' . $user->username . '/packages') }}">{{ url('locals/@' . $user->username . '/packages') }}</a>
@else
    <p>{{ __('messages.email_expired_package') }}:</p>
    <a href="{{ url('locals/@' . $user->username . '/packages') }}">{{ url('local/@' . $user->username . '/packages') }}</a>
@endif