<?php


move_uploaded_file(123123123, 'uploads/image.jpg');



$user = new User;
$user->login('rahim@marlindev.ru', '123123');



























exit;
require_once 'init.php';

//echo Session::get(Config::get('session.user_session'));
echo Session::flash('success');
$user = new User;
if($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>";
    echo "<p><a href='logout.php'>Logout</a></p>";
    echo "<p><a href='update.php'>Update profile</a></p>";
    echo "<p><a href='changepassword.php'>Change password</a></p>";

    if($user->hasPermissions('manager')) {
        echo 'You are admin!';
    }
} else {
    echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}