<?php
require_once 'init.php';
$page_title = 'Авторизация';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();

		$validate->check($_POST, [
			'email' => [
				'required' => true,
				'email' => true
			],
			'password' => [
				'required' => true
			]
		]);
		
		if($validate->passed()) {
			$user = new User;
			$remember = (Input::get('remember')) === 'on' ? true : false;

			$login = $user->login(Input::get('email'), Input::get('password'), $remember);

			if($login) {
				Redirect::to();
			} else {
				Session::setFlash('Неправильный логин или пароль');
			}
		} else {
			$errors = '';
			foreach ($validate->errors() as $error) {
				$errors .= $error . '<br>';
			}
			Session::setFlash($errors);
		}
	}
}
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=isset($page_title) ? $page_title : Config::get('site.name')?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
	<?php
	//var_dump($_SESSION);
	?>
	<?php Form::begin([
		'method' => 'post',
		'class' => "form-signin",
	]);?>
		<a href="<?=Config::get('site.baseurl')?>"><img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72"></a>
		<h1 class="h3 mb-3 font-weight-normal"><?=isset($page_title) ? $page_title : Config::get('site.name')?></h1>

		<?php
			if (Session::exists('success')) {
				echo '<div class="alert alert-success">' . Session::getFlash('success') . '</div>';
			} 
			
			if (Session::exists('danger')) {
				echo '<div class="alert alert-danger">' . Session::getFlash('danger') . '</div>';
			} 

			if (Session::exists('info')) {
				echo '<div class="alert alert-info">' . Session::getFlash('info') . '</div>';
			}
		?>

		<div class="form-group">
			<?php Form::input('email', [
				'class' => 'form-control',
				'type' => 'email',
				'placeholder' => 'Email',
				'value' => Input::get('email'),
			]); ?>
		</div>

		<div class="form-group">
			<?php Form::input('password', [
				'class' => 'form-control',
				'type' => 'password',
				'placeholder' => 'Пароль',
			]); ?>
		</div>

		<div class="checkbox mb-3">
			<?php Form::input('remember', [
				'label' => 'Запомнить меня',
				'label_after' => true,
				'type' => 'checkbox',
			]); ?>
		</div>

		<?php Form::input('token'); ?>

		<?php Form::button([
			'class' => 'btn btn-lg btn-primary btn-block',
			'type' => 'submit',
		], 'Войти'); ?>

		<p class="mt-5 mb-3 text-muted">&copy; 2017-<?=date('Y')?></p>
	<?php Form::end();?>
</body>
</html>
