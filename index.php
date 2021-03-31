<?php
require_once 'init.php';

require 'header.php';
?>
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1 class="display-4">Привет<?= $user->isLoggedIn() ? ', ' . $user->data()->username : '' ?>!</h1>
					<p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
					<?php if (!$user->isLoggedIn()): ?>
						<hr class="my-4">
						<p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
						<a class="btn btn-primary btn-lg" href="<?=Config::get('site.baseurl')?>/register.php" role="button">Зарегистрироваться</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

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

			if ($users = Database::getInstance()->getAll('users')->results()):
		?>
			<div class="row">
				<div class="col-md-12">
					<h1>Пользователи</h1>
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Имя</th>
								<th>Email</th>
								<th>Дата</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach($users as $user): ?>
								<tr>
									<td><?=$user->id?></td>
									<td><a href="<?=Config::get('site.baseurl')?>/user_profile.php?id=<?=$user->id?>"><?=$user->username?></a></td>
									<td><a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
									<td><?=date('d.m.Y', strtotime($user->reg_date))?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php else: ?>
			<h2>Пользователей не найдено. <a href="<?=Config::get('site.baseurl')?>/register.php">Станьте первым!</a></h2>
		<?php endif; ?>
	</div>
</body>
</html>
