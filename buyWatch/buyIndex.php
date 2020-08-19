<?php include_once 'config/init.php'; ?>

<?php

$template = new Template('templates/userViews/buy.php');

$orders = new Orders;
$bank = new Bank;
$product = new Product;
$user = new User;
$favorite = new Favorite;


$cardName = "";
$cardPassword = "";
$customerNr = 0;

$productId = isset($_GET['id']) ? $_GET['id'] : null;


$productNr = 0;

$checkNr = 0;

$error = 0;

$method = 0;

$cost = 0;

$orderFee = 0;

$idBank = 0;

$productDeliv = "";


//$productNr = $product->getProduct($productId)->productPrice;

if(isset($_POST['do_buy'])){
  $data = array();
  $data['customerName'] = test_input($_POST['customerName']);
  $data['customerAddress'] = test_input($_POST['customerAddress']);
  $data['customerPhone'] = test_input($_POST['customerPhone']);
  $data['customerNumberWatches'] = test_input($_POST['customerNumberWatches']);
  $data['userId'] = $_SESSION['user_id'];
  $data['productId'] = $_POST['productId'];
  $pay = $_POST['payMethod'];


  $id = $_POST['productId'];
  $productNr = $product->getProduct($id)->productCount;
  $customerNr = test_input($_POST['customerNumberWatches']);


  $method = test_input($_POST['deliveryMethod']);

  $productDeliv = $product->getProduct($id)->deliveryMethod;

  if($method == 1 && $productDeliv == "To Our Showroom"){
    $error = 5;
  }else if($method == 2 && $productDeliv == "To Your Home"){
    $error = 6;
  }

  if($method == 2){
    $data['deliveryMethod'] = "To Our Showroom";
    $orderFee = 0;
  }else if($method == 1){
    $data['deliveryMethod'] = "To Your Home";
    $orderFee = 15;
  }

  if($pay == 1){
    if($productNr < $customerNr){
      $error = 3;
    }else{
      $dif = $productNr - $customerNr;
      $product->updateCount($id, $dif);
      $productNr = $product->getProduct($id)->productCount;
      if($productNr == 0){
        $product->updateStock($id, "Not In Stock");
      }
    }
  }

  if($pay == 2){
    if($productNr < $customerNr){
      $error = 3;
    }else{
      $dif = $productNr - $customerNr;
      $product->updateCount($id, $dif);
      $productNr = $product->getProduct($id)->productCount;
      if($productNr == 0){
        $product->updateStock($id, "Not In Stock");
      }
    }
  }

  $productPrice = $product->getProduct($id)->productPrice;

  if($orderFee == 0){
    $productCost = $productPrice * $customerNr;
    $data['totalPayment'] = $productCost;
  }else if($orderFee > 0){
    $productCost = ($productPrice * $customerNr) + $orderFee;
    $data['totalPayment'] = $productCost;
  }

  $userMoney = $user->getUser($_SESSION['user_id'])->userMoney;

  if($pay == 1){
    if($userMoney < $productCost){
      $error = 4;
    }else{
      $userMoney = $userMoney - $productCost;
      $user->updateMoney($_SESSION['user_id'], $userMoney);
    }
  }




  $cardName = test_input($_POST['customerCardName']);
  $cardPassword = test_input($_POST['customerCardPassword']);





/*  if($productNr < $customerNr){
    $error = 3;
  }*/

  $idBank = $user->getUser($_SESSION['user_id'])->bankId;

  if($pay == 1){
    if(!($bank->validateCardId($cardName, $cardPassword, $idBank))){
      $error = 1;
    }
  }


  if(!is_numeric($_POST['customerPhone']) || !is_numeric($_POST['customerNumberWatches'])){
    $error = 2;
  }


  if($error == 0){
  if($orders->createOrder($data)){

      $idFav = $favorite->selectFavorite($_SESSION['user_id'], $id)->idFavorite;

      echo 1;


  }else{

    echo 2;
  }
}else if($error == 1){
  echo 3;
}else if($error == 2){
  echo 4;
}else if($error == 3){
  echo 5;
}else if($error == 4){
  echo 6;
}else if($error == 5){
  echo 7;
}else if($error == 6){
  echo 8;
}

if($error == 0){
        $favorite->deleteFavorite($idFav);
}

}else{
  $template->products = $product->getProduct($productId);
  echo $template;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
