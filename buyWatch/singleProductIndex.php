<?php include_once 'config/init.php'; ?>

<?php

$template = new Template('templates/userViews/singleProduct.php');

$product = new Product;

$product_id = isset($_GET['id']) ? $_GET['id'] : null;


$template->singleProduct = $product->getProduct($product_id);


echo $template;
