<?php include_once 'config/init.php'; ?>

<?php

$user = new User;
$bank = new Bank;

$error = 0;

$origPass = "";
$copyPass = "";

$origPassCard = "";
$copyPassCard = "";

$cardName = "";
$cardPassword = "";

if(isset($_POST['do_register'])){
  $data = array();
  $data['userName'] = test_input($_POST['userName']);
  $data['userPassword'] = test_input($_POST['userPassword']);
  $data['userAddress'] = test_input($_POST['userAddress']);
  $data['userCardName'] = test_input($_POST['userCardName']);
  $data['userCardPassword'] = test_input($_POST['userCardPassword']);
  $data['userMoney'] = test_input($_POST['userMoney']);

  $cardName = test_input($_POST['userCardName']);
  $cardPassword = test_input($_POST['userCardPassword']);

  if(!($bank->validateCard($cardName, $cardPassword))){
    $error = 7;
  }else{
    $data['bankId'] = $bank->validateCard($cardName, $cardPassword)->cardId;
  }


 if(!is_numeric($_POST['userMoney'])){
   $error = 6;
 }

  $origPass =$_POST['userPassword'];
  $copyPass = $_POST['userPasswordConfirmation'];

  if($origPass != $copyPass){
    $error = 1;
  }

  $origPassCard = $_POST['userCardPassword'];
  $copyPassCard = $_POST['userCardPasswordConfirmation'];

  if($origPassCard != $copyPassCard){
    $error = 2;
  }

  if($error == 0){
    if($user->createUser($data)){
      echo 1;
    }else{
      echo 2;
    }
  }else if($error == 1){
    echo 3;
  }else if($error == 2){
    echo 4;
  }else if($error == 6){
    echo 6;
  }else if($error == 7){
    echo 7;
  }

}else{
  $template = new Template('templates/userViews/register.php');
  echo $template;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
