<?php include_once 'config/init.php'; ?>

<?php

$admin = new Admin;
$user = new User;

$_SESSION['acces_admin'] = 0;
$_SESSION['acces_user'] = 0;


if(isset($_POST['do_login'])){
  $uname = $_POST['username'];
  $pass = $_POST['password'];

  if($admin->login($uname, $pass)){
    $_SESSION['user_info'] = $uname;
    $_SESSION['user_password'] = $pass;
    $_SESSION['user_id'] = $admin->login($uname,$pass)->adminId;

    $_SESSION['acces_admin'] = 1;

    echo 1;
  }else if($user->loginUser($uname, $pass)){
    $_SESSION['user_info'] = $uname;
    $_SESSION['user_password'] = $pass;
    $_SESSION['user_id'] = $user->loginUser($uname,$pass)->userId;

    $_SESSION['acces_user'] = 1;

    echo 2;
  }else{
    echo 0;
  }



}else{
    $template = new Template('templates/login.php');
    echo $template;
}

?>
