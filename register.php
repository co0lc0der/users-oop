<?php
require_once 'init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
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
            ]
        ]);


        if($validation->passed()) {

            //Database
            $user = new User;

            $user->create([
                'username'   => Input::get('username'),
                'password'   =>  password_hash(Input::get('password'), PASSWORD_DEFAULT),
                'email' =>  Input::get('email')
            ]);


            Session::flash('success', 'register success');
//            header('Location: /test.php');

        } else {
            foreach($validation->errors() as $error) {
                echo $error . "<br>";
            }
        }
    }
}


?>

<form action="" method="post">
    <?php echo Session::flash('success'); ?>
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username')?>">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo Input::get('email')?>">
    </div>

    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password" >
    </div>

    <div class="field">
        <label for="">Password Again</label>
        <input type="text" name="password_again">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>
