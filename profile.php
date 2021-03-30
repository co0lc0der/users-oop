<?php
require_once 'init.php';

$user = new User();
if (!$user->data()) Redirect::to();

$page_title = 'Профиль пользователя - ' . $user->data()->username;

$validate = new Validate();
$validate->check($_POST, [
  'username' => [
    'required' => true,
    'min' => 2
  ]
]);

if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
    if ($validate->passed()) {
      $user->update([
        'username' => Input::get('username'),
        'status' => Input::get('status'),
      ]);

      Session::setFlash('Профиль обновлен', 'success');
      Redirect::to('profile.php');
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

        <?php if (Session::exists('success')) {
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
        ]);?>
          <div class="form-group">
            <?php Form::input('username', [
              'class' => 'form-control',
              'label' => 'Имя',
              'value' => $user->data()->username,
            ]); ?>
          </div>

          <div class="form-group">
            <?php Form::input('status', [
              'class' => 'form-control',
              'label' => 'Статус',
              'value' => $user->data()->status,
            ]); ?>
          </div>

          <?php Form::input('token'); ?>

          <div class="form-group">
            <?php Form::button([
              'class' => 'btn btn-warning',
              'type' => 'submit',
            ], 'Обновить профиль'); ?>

            <a href="changepassword.php" class="ml-3 btn btn-secondary">Изменить пароль</a>
          </div>
        <?php Form::end();?>
      </div>
    </div>
  </div>
</body>
</html>
