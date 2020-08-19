<?php include_once 'config/init.php'; ?>

<?php



$category = new Category;
$product = new Product;

$method = 0;
$deliveryMethod = "";

//$template->categories = $category->getCategories();
if(isset($_POST['del_id'])){
  $del_id = $_POST['del_id'];
  if($product->deleteProduct($del_id)){
    redirect('searchAdminIndex.php', 'Watch Deleted', 'succes');
  }else{
    redirect('searchAdminIndex.php', 'Watch Not Deleted', 'error');
  }
}

$productId = isset($_GET['id']) ? $_GET['id'] : null;

if(isset($_POST['do_login'])){

  $method = $_POST['deliveryMethod'];

  if($method == 1){
    $deliveryMethod = "To Our Showroom";
  }else if($method == 2){
    $deliveryMethod = "To Your Home";
  }else if($method == 3){
    $deliveryMethod = "Both";
  }



  $data = array();
  $data['productName'] = $_POST['productName'];
  $data['categoryId'] = $_POST['productCategory'];
  $data['productDescription'] = $_POST['productDescription'];
  $data['productSpecs'] = $_POST['productSpecs'];
  $data['productPrice'] = $_POST['productPrice'];
  $data['productCount'] = $_POST['productCount'];
  $data['productStock'] = $_POST['productStock'];
  $data['productProvider'] = $_POST['productProvider'];
  $data['deliveryMethod'] = $deliveryMethod;

  $var = $_POST['productId'];



  if($product->editProduct($var,$data)){
    echo 1;

  }else{
    echo 3;
  }

}else{
  $template = new Template('templates/editProducts.php');
  $template->categories = $category->getCategories();
  $template->products = $product->getProduct($productId);
  echo $template;
}
