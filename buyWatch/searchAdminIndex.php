<?php include_once 'config/init.php'; ?>

<?php

$template = new Template('templates/searchAdmin.php');


$category = new Category;
$product = new Product;

$stock = "";
$providerName = "";
$deliveryMethod = "";
$prodName = "";

$categId = isset($_GET['categorySelect']) ? $_GET['categorySelect'] : null;
$sortPrice = isset($_GET['sortAfterPrice']) ? $_GET['sortAfterPrice'] : null;
$stock = (!isset($_GET['inStock'])) ? "Not In Stock" : "In Stock";
$provider = isset($_GET['chooseProvider']) ? $_GET['chooseProvider'] : null;
$method = isset($_GET['chooseMethod']) ? $_GET['chooseMethod'] : null;
$search = isset($_GET['myInput']) ? $_GET['myInput'] : "";

if($method == 1){
  $deliveryMethod = "To Our Showroom";
}else if($method == 2){
  $deliveryMethod = "To Your Home";
}else if($method == 3){
  $deliveryMethod = "Both";
}else{
  $deliveryMethod = "Nothing";
}

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

if($search != ""){
  $prodName = $search;
  $template->title = "You searched: ".$prodName;
  $template->products = $product->getProductByName($prodName);
}
else if($categId && $sortPrice == 0 && $provider == 0){
    if($stock == 'Not In Stock'){
      $template->products = $product->getByCategory($categId, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches";
    }else if($stock == 'In Stock'){
      $template->products = $product->getByCategoryInStock($categId, $stock, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches";
    }
}else if($categId && $sortPrice ==0 && $provider){
    if($stock == 'Not In Stock'){
      $template->products = $product->getByCategoryAndProvider($categId, $providerName, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches";
    }else if($stock == 'In Stock'){
      $template->products = $product->getByCategoryInStockAndProvider($categId, $stock, $provider, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches";
    }
}else if($categId == 0 && $sortPrice != 0 && $provider == 0){
    if($sortPrice == 1){
      if($stock == 'Not In Stock'){
        $template->products = $product->getAllProductsByAscendingPrice($deliveryMethod);
        $template->title = "Watches in ascending order:";
      }else if($stock == "In Stock"){
        $template->products = $product->getAllProductsByAscendingPriceInStock($stock, $deliveryMethod);
        $template->title = "Watches in ascending order:";
      }
    }else if($sortPrice == 2){
      if($stock == 'Not In Stock'){
        $template->products = $product->getAllProductsByDescendingPrice($deliveryMethod);
        $template->title = "Watches in descending order:";
      }else if($stock == 'In Stock'){
        $template->products = $product->getAllProductsByDescendingPriceInStock($stock, $deliveryMethod);
        $template->title = "Watches in descending order:";
      }
    }
}else if($categId == 0 && $sortPrice != 0 && $provider !=0){
    if($sortPrice == 1){
      if($stock == 'Not In Stock'){
        $template->products = $product->getAllProductsByAscendingPriceAndProvider($providerName, $deliveryMethod);
        $template->title = "Watches in ascending order:";
      }else if($stock == "In Stock"){
        $template->products = $product->getAllProductsByAscendingPriceInStockAndProvider($stock, $providerName, $deliveryMethod);
        $template->title = "Watches in ascending order:";
      }
    }else if($sortPrice == 2){
      if($stock == 'Not In Stock'){
        $template->products = $product->getAllProductsByDescendingPriceAndProvider($providerName, $deliveryMethod);
        $template->title = "Watches in descending order:";
      }else if($stock == 'In Stock'){
        $template->products = $product->getAllProductsByDescendingPriceInStockAndProvider($stock, $deliveryMethod);
        $template->title = "Watches in descending order:";
      }
    }
}else if($categId != 0 && $sortPrice && $provider == 0){
    if($sortPrice == 1){
      if($stock == 'Not In Stock'){
        $template->products = $product->getByCategoryAscending($categId, $deliveryMethod);
        $template->title = $category->getCategory($categId)->categoryName . " watches in ascending order";
      }else if($stock == 'In Stock'){
        $template->products = $product->getByCategoryAscendingInStock($categId, $stock, $deliveryMethod);
        $template->title = $category->getCategory($categId)->categoryName . " watches in ascending order";
      }
    }else if($sortPrice == 2){
      if($stock == "Not In Stock"){
        $template->products = $product->getByCategoryDescending($categId, $deliveryMethod);
        $template->title = $category->getCategory($categId)->categoryName . " watches in descending order";
      }else if($stock == "In Stock"){
        $template->products = $product->getByCategoryDescendingInStock($categId, $stock, $deliveryMethod);
        $template->title = $category->getCategory($categId)->categoryName . " watches in descending order";
      }

    }
}else if($categId != 0 && $sortPrice !=0 && $provider!=0){
  if($sortPrice == 1){
    if($stock == 'Not In Stock'){
      $template->products = $product->getByCategoryAscendingAndProvider($categId, $providerName);
      $template->title = $category->getCategory($categId)->categoryName . " watches in ascending order";
    }else if($stock == 'In Stock'){
      $template->products = $product->getByCategoryAscendingInStockAndProvider($categId, $stock, $providerName, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches in ascending order";
    }
  }else if($sortPrice == 2){
    if($stock == "Not In Stock"){
      $template->products = $product->getByCategoryDescendingAndProvider($categId, $providerName, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches in descending order";
    }else if($stock == "In Stock"){
      $template->products = $product->getByCategoryDescendingInStockAndProvider($categId, $stock, $providerName, $deliveryMethod);
      $template->title = $category->getCategory($categId)->categoryName . " watches in descending order";
    }

  }
}else if($categId == 0 && $sortPrice == 0 && $provider == 0){
  if($stock == "Not In Stock"){
    $template->products = $product->getAllProducts();
    $template->title = "The latest watches added:";
  }else if($stock == "In Stock"){
    $template->products = $product->getAllProductsInStock($stock);
    $template->title = "The latest watches added in stock:";
  }
}else if($categId == 0 && $sortPrice == 0 && $provider != 0){
  if($stock == "Not In Stock"){
    $template->products = $product->getByProvider($providerName, $deliveryMethod);
    $template->title = "The latest watches added:";
  }else if($stock == "In Stock"){
    $template->products = $product->getByProviderInStock($providerName, $deliveryMethod, $stock);
    $template->title = "The latest watches added in stock:";
  }
}
else {
    $template->products = $product->getAllProducts();
    $template->title = "The latest watches added:";
}




$template->categories = $category->getCategories();

echo $template;
