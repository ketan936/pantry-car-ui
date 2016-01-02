<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],

	'facebook' => [
	  'client_id' => getenv('FACEBOOK_CLIENT_ID'),
      'client_secret' => getenv('FACEBOOK_CLIENT_SECRET'),
      'redirect' => PHP_SAPI === 'cli' ? false : url('/account/facebook'),
	],

	'google' => [
	  'client_id' => '641991480398-tcscgo5bk3oq4e7o1gr8ed131r683gvf.apps.googleusercontent.com',
      'client_secret' => 'sRx5reVY30LxLJlOF0s-3i7N',
      'redirect' => PHP_SAPI === 'cli' ? false:url('/account/google'),
	]

];
