<?php
require_once '../init.php';

$user = new User();
if (!$user->data() || !$user->hasPermissions('admin')) Redirect::to();

$page_title = 'Пользователи';
require '../header.php';
?>
    <div class="container">
      <?php 
        //select u.id, u.email, u.username, g.name from `users` as `u`, `groups` as `g` where u.group_id = g.id
        //select u.id, u.email, u.username, g.permissions from `users` as `u` inner join `groups` as `g` on u.group_id = g.id
        //$users = Database::getInstance()->getAll('users')->results();
        //getFields($fields, $table, $where = [])
        $users = Database::getInstance()->query('SELECT u.id, u.email, u.username, g.permissions FROM `users` AS `u` INNER JOIN `groups` AS `g` ON u.group_id = g.id')->results();
        //var_dump($_SESSION);die;
      ?>
      <div class="col-md-12">
        <h1><?=$page_title?></h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Администратор</th>
              <th>Действия</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($users as $user): ?>
              <tr>
                <td><?=$user->id?></td>
                <td><?=$user->username?></td>
                <td><a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
                <td>
                  <?php if (User::checkPermissions($user->permissions, 'admin')): ?>
                    <a href="<?=Config::get('site.baseurl')?>/users/manage.php?act=downgrade&id=<?=$user->id?>" class="btn btn-sm btn-danger">Разжаловать</a>
                  <?php else: ?>
                    <a href="<?=Config::get('site.baseurl')?>/users/manage.php?act=grade&id=<?=$user->id?>" class="btn btn-sm btn-sm btn-success">Назначить</a>
                  <?php endif; ?>
                </td>
                <td class="d-flex justify-content-between">
                  <a href="<?=Config::get('site.baseurl')?>/user_profile.php?id=<?=$user->id?>" class="btn btn-sm btn-info">Посмотреть</a>
                  <a href="<?=Config::get('site.baseurl')?>/users/edit.php?id=<?=$user->id?>" class="btn btn-sm btn-warning">Редактировать</a>
                  <a href="<?=Config::get('site.baseurl')?>/users/manage.php?act=delete&id=<?=$user->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <!-- <tr>
              <td>1</td>
              <td>Rahim</td>
              <td>rahim@marlindev.ru</td>
              <td class="d-flex justify-content-between">
              	<a href="#" class="btn btn-sm btn-sm btn-success">Назначить администратором</a>
                <a href="#" class="btn btn-sm btn-info">Посмотреть</a>
                <a href="#" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td>John</td>
              <td>john@marlindev.ru</td>
              <td class="d-flex justify-content-between">
              	<a href="#" class="btn btn-sm btn-danger">Разжаловать</a>
                <a href="#" class="btn btn-sm btn-info">Посмотреть</a>
                <a href="#" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
              </td>
            </tr>

            <tr>
              <td>3</td>
              <td>Jane</td>
              <td>jane@marlindev.ru</td>
              <td class="d-flex justify-content-between">
              	<a href="#" class="btn btn-sm btn-success">Назначить администратором</a>
                <a href="#" class="btn btn-sm btn-info">Посмотреть</a>
                <a href="#" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
              </td>
            </tr> -->
          </tbody>
        </table>
      </div>

    </div>  
  </body>
</html>
