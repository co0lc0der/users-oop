<?php
session_start();

// подключаем файлы классов
foreach (glob(__DIR__ . "/classes/*.php") as $file) {
	require_once $file;
}

$GLOBALS['config'] = [
	'debug' => true,

	'site' => [
		//'host'  =>  $_SERVER['HTTP_HOST'],
		'baseurl' => 'http://' . $_SERVER['HTTP_HOST'] . '',
		'name' => 'User Management',
	],

	'dbdriver' => 'sqlite', // <------------ указать драйвер БД!

	'mysql' =>  [
		'host'  =>  'localhost',
		'username'  =>  'root',
		'password'  =>  '',
		'database'  =>  'test',
	],

	'sqlite' => [
		'database'  =>  __DIR__ . '/users.sqlite3',
	],

	'session'  =>  [
		'token_name'    =>  'token',
		'user_session'  =>  'user'
	],

	'cookie'    =>  [
		'cookie_name'   =>  'hash',
		'cookie_expiry' =>  604800
	]
];

if (Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))) {
	$hash = Cookie::get(Config::get('cookie.cookie_name'));
	$hashCheck = Database::getInstance()->get('user_sessions', ['hash', '=', $hash]);

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
		Redirect::to();
	}
}
