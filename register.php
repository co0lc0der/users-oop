<?php
require_once 'init.php';
$page_title = 'Регистрация';
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
	<?php Form::begin([
		'method' => 'post',
		'class' => "form-signin",
	]);?>
		<a href="<?=Config::get('site.baseurl')?>"><img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72"></a>
		<h1 class="h3 mb-3 font-weight-normal"><?=isset($page_title) ? $page_title : Config::get('site.name')?></h1>

		<?php
			if (Input::exists()) {
				if (Token::check(Input::get('token'))) {
					$validate = new Validate();
			
					$validation = $validate->check($_POST, [
						'username'  =>  [
							'required'  =>  true,
							'min'   =>  2,
							'max'   =>  15,
						],
						'email' =>  [
							'required'  =>  true,
							'email' =>  true,
							'unique'    =>  'users'
						],
						'password' => [
							'required'  =>  true,
							'min'   =>  3
						],
						'password_again' => [
							'required'  =>  true,
							'matches'   => 'password'
						],
						'agree' => [
							'required'  =>  true,
						]
					]);
			
					if($validation->passed()) {
						$user = new User;
			
						$created = $user->create([
							'username'   => Input::get('username'),
							'password'   =>  password_hash(Input::get('password'), PASSWORD_DEFAULT),
							'email' =>  Input::get('email'),
							'reg_date' => date('Y-m-d', time()),
							'group_id' => 1
						]);
			
						if ($created) {
							Session::setFlash('Регистрация прошла успешно', 'success');
							Redirect::to();
						}
					} else {
						echo '<div class="alert alert-danger">';
						foreach($validation->errors() as $error) {
							echo $error . '<br>';
							//Session::setFlash('danger', $error);
						}
						echo '</div>';
					}
				}
			}

			if ($flash = Session::getFlash('danger')) {
				echo '<div class="alert alert-danger">' . $flash . '</div>';
			}

			if ($flash = Session::getFlash('success')) {
				echo '<div class="alert alert-success">' . $flash . '</div>';
			}

			if ($flash = Session::getFlash('info')) {
				echo '<div class="alert alert-info">' . $flash . '</div>';
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
			<?php Form::input('username', [
				'class' => 'form-control',
				'placeholder' => 'Ваше имя',
				'value' => Input::get('username'),
			]); ?>
		</div>

		<div class="form-group">
			<?php Form::input('password', [
				'class' => 'form-control',
				'type' => 'password',
				'placeholder' => 'Пароль',
			]); ?>
		</div>

		<div class="form-group">
			<?php Form::input('password_again', [
				'class' => 'form-control',
				'type' => 'password',
				'placeholder' => 'Повторите пароль',
			]); ?>
		</div>

		<div class="checkbox mb-3">
			<?php Form::input('agree', [
				'label' => 'Согласен со всеми правилами',
				'label_after' => true,
				'type' => 'checkbox',
			]); ?>
		</div>

		<?php Form::input('token'); ?>

		<?php Form::button([
			'class' => 'btn btn-lg btn-primary btn-block',
			'type' => 'submit',
		], 'Зарегистрироваться'); ?>

		<p class="mt-5 mb-3 text-muted">&copy; 2017-<?=date('Y')?></p>
	<?php Form::end();?>
</body>
</html>
