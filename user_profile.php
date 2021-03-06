<?php
require_once 'init.php';
$page_title = 'Данные пользователя';
require 'header.php';

$user = new User(Input::get('id'));
if (!$user->exists()) Redirect::to();
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?=isset($page_title) ? $page_title : Config::get('site.name')?></h1>
        <table class="table">
          <thead>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата регистрации</th>
            <th>Статус</th>
          </thead>
          <tbody>
            <tr>
              <td><?=$user->data()->id?></td>
              <td><?=$user->data()->username?></td>
              <td><?=date('d.m.Y', strtotime($user->data()->reg_date))?></td>
              <td><?=$user->data()->status?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
