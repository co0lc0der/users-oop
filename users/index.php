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
                  <a href="<?=Config::get('site.baseurl')?>/users/manage.php?act=remove&id=<?=$user->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>  
  </body>
</html>
