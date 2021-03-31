<?php

class Session
{
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function exists($name) {
		return (isset($_SESSION[$name]) && $_SESSION[$name] !== '') ? true : false;
	}

	public static function delete($name) {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function setFlash($string, $name = 'danger') {
		if(self::exists($name)) {
			$prev = self::get($name) . ' ' . $string;
			self::put($name, $prev);
		} else {
			self::put($name, $string);
		}
	}

	public static function getFlash($name) {
		if(self::exists($name)) {
			$session = self::get($name);
			self::delete($name);
			return $session;
		}
	}

	public static function destroy() {
		session_destroy();
	}
}
