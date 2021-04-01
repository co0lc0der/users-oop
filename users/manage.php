<?php
require_once '../init.php';

$id = Input::get('id');
$action = Input::get('act');

$current_user = new User();
$user = new User($id);

if (!$user->exists() || !$current_user->exists() || !$current_user->hasPermissions('admin')) Redirect::to();

switch ($action) {
  case 'downgrade':
    $user->update([
      'group_id' => 1,
    ], $id);
    Session::setFlash('Права изменены', 'info');
    break;
  case 'grade':
    $user->update([
      'group_id' => 2,
    ], $id);
    Session::setFlash('Права изменены', 'info');
    break;
  case 'remove':
    $user->remove();
    Session::setFlash('Пользователь удален', 'info');
    break;
}

Redirect::to('index.php');
