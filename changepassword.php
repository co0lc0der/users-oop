<?php
require_once 'init.php';

$user = new User();
if (!$user->exists()) Redirect::to();

$page_title = 'Изменить пароль пользователя ' . $user->data()->username;

$validate = new Validate();
$validate->check($_POST, [
	'current_password' => [
		'required' => true,
		'min' => 6
	],
	'new_password' => [
		'required' => true,
		'min' => 6
	],
	'new_password_again' => [
		'required' => true,
		'min' => 6,
		'matches' => 'new_password'
	],
]);

if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		if ($validate->passed()) {
			if (password_verify(Input::get('current_password'), $user->data()->password)) {
				$user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
				
				Session::setFlash('Пароль успешно обновлен', 'success');
				Redirect::to('profile.php');
			} else {
				Session::setFlash('Неверный текущий пароль');
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

require 'header.php';
?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1><?=$page_title?></h1>

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

					Form::begin([
						'method' => 'post',
						'class' => "form",
					]);
				?>
					<div class="form-group">
						<?php Form::input('current_password', [
							'class' => 'form-control',
							'type' => 'password',
							'label' => 'Текущий пароль',
						]); ?>
					</div>

					<div class="form-group">
						<?php Form::input('new_password', [
							'class' => 'form-control',
							'type' => 'password',
							'label' => 'Новый пароль',
						]); ?>
					</div>

					<div class="form-group">
						<?php Form::input('new_password_again', [
							'class' => 'form-control',
							'type' => 'password',
							'label' => 'Повторите новый пароль',
						]); ?>
					</div>

					<?php Form::input('token'); ?>

					<div class="form-group">
						<?php Form::button([
							'class' => 'btn btn-warning',
							'type' => 'submit',
						], 'Изменить пароль'); ?>
						<a href="<?=Config::get('site.baseurl')?>/profile.php" class="ml-3 btn btn-secondary">Изменить профиль</a>
					</div>
				<?php Form::end();?>
			</div>
		</div>
	</div>
</body>
</html>
