<?php include_once 'config/init.php'; ?>

<?php

//$template = new Template('templates/addWatch.php');

$category = new Category;
$product = new Product;

//$template->categories = $category->getCategories();

$error = 0;
$method = 0;
$deliveryMethod = "";
$provider = 0;
$providerName = "";

if(isset($_POST['do_login'])){

  $method = test_input($_POST['deliveryMethod']);

  if($method == 1){
    $deliveryMethod = "To Our Showroom";
  }else if($method == 2){
    $deliveryMethod = "To Your Home";
  }else if($method == 3){
    $deliveryMethod = "Both";
  }

  $provider = test_input($_POST['productProvider']);

  if($provider == 1){
    $providerName = "Emag";
  }else if($provider == 2){
    $providerName = "Alibaba";
  }else if($provider == 3){
    $providerName = "Amazon";
  }else if($provider == 4){
    $providerName = "Ebay";
  }else if($provider == 5){
    $providerName = "TopWatch";
  }else{
    $providerName = "";
  }

  $data = array();
  $data['productName'] = test_input($_POST['productName']);
  $data['categoryId'] = test_input($_POST['productCategory']);
  $data['productDescription'] = test_input($_POST['productDescription']);
  $data['productSpecs'] = test_input($_POST['productSpecs']);
  $data['productPrice'] = test_input($_POST['productPrice']);
  $data['productCount'] = test_input($_POST['productCount']);
  $data['productStock'] = test_input($_POST['productStock']);
  $data['productProvider'] = $providerName;
  $data['deliveryMethod'] = $deliveryMethod;

  if(!is_numeric($_POST['productCount'])){
    $error = 1;
  }
  if($error == 0){
  if($product->createProduct($data)){
    echo 1;
  }else{
    echo 2;
  }
}else{
  echo 3;
}

}else{
  $template = new Template('templates/addWatch.php');
  $template->categories = $category->getCategories();
  echo $template;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//echo $template;
