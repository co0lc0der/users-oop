<?php

class Redirect
{
	public static function to($location = 'index.php') {
		if(is_numeric($location)) {
			switch ($location) {
				case 403:
					header('HTTP/1.0 403 Forbidden.');
					include 'includes/errors/403.php';
					exit;
				break;
				case 404:
					header('HTTP/1.0 404 Not Found.');
					include 'includes/errors/404.php';
					exit;
				break;
			}
		}

		header('Location:' . $location);
		exit;
	}
}
