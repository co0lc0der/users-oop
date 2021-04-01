<?php
	$user = new User;
	//var_dump($user);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=isset($page_title) ? $page_title : Config::get('site.name')?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
		<a class="navbar-brand" href="<?=Config::get('site.baseurl')?>"><?=Config::get('site.name')?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?=Config::get('site.baseurl')?>">Главная</a>
				</li>
				<?php if ($user->isLoggedIn() && $user->hasPermissions('admin')) { ?>
					<li class="nav-item">
						<a href="<?=Config::get('site.baseurl')?>/users/index.php" class="nav-link">Управление пользователями</a>
					</li>
				<?php } ?>
			</ul>

			<ul class="navbar-nav">
				<?php if ($user->isLoggedIn()) { ?>
					<li class="nav-item">
						<a href="<?=Config::get('site.baseurl')?>/profile.php" class="nav-link">Профиль</a>
					</li>
					<li class="nav-item">
						<a href="<?=Config::get('site.baseurl')?>/logout.php" class="nav-link">Выйти</a>
					</li>
				<?php } else { ?>
					<li class="nav-item">
						<a href="<?=Config::get('site.baseurl')?>/login.php" class="nav-link">Войти</a>
					</li>
					<li class="nav-item">
						<a href="<?=Config::get('site.baseurl')?>/register.php" class="nav-link">Регистрация</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</nav>
