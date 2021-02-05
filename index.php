<?php
require_once 'init.php';

include "header.php";
?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron">
					<h1 class="display-4">Привет, мир!</h1>
					<p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
					<hr class="my-4">
					<p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
					<a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>
				</div>
			</div>
		</div>

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
						<tr>
							<td>1</td>
							<td><a href="#">Rahim</a></td>
							<td>rahim@marlindev.ru</td>
							<td>12/03/2025</td>
						</tr>

						<tr>
							<td>2</td>
							<td><a href="#">John</a></td>
							<td>john@marlindev.ru</td>
							<td>12/03/2025</td>
						</tr>

						<tr>
							<td>3</td>
							<td><a href="#">Jane</a></td>
							<td>jane@marlindev.ru</td>
							<td>12/03/2025</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>