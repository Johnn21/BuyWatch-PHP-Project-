<?php include_once 'config/init.php'; ?>

<?php

$template = new Template('templates/userViews/addFavorite.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

$favorite = new Favorite;
$product = new Product;

$user_id = $_SESSION['user_id'];

/*$message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";*/



if($product_id != 0){

  if(!($favorite->checkIfExists($user_id, $product_id))){
    $favorite->createFavorite($user_id,$product_id);
  }else{
    echo "<script type='text/javascript'>alert('You already have this watch in favorites!');</script>";
  }


}

$template->products = $product->selectFavoriteProduct($user_id);




echo $template;
