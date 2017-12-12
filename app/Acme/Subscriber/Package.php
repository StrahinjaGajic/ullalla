<?php

namespace Acme\Subscriber;

class Package
{
	public function onGetSignin($user)
	{
		return 'asdasd';
	}	

	public function subscribe($events)
	{
		$events->listen('auth.getSignin', 'Acme\Subscriber\Package@onGetSignin');
	}
}