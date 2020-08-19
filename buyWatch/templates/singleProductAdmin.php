<?php include 'inc/header.php';?>
<br><br>
<h3 class="header"><?php echo $singleProduct->productName; ?></h3>
<small>Posted on <?php echo $singleProduct->productDate; ?></small>
<br><br>

  <ul>
    <li><strong>Product Specifications: </strong><?php echo $singleProduct->productSpecs; ?></li>
    <li><strong>Product Specifications: </strong><?php echo $singleProduct->productPrice; ?></li>
    <li><strong>Product Count: </strong><?php echo $singleProduct->productCount; ?></li>
    <li><strong>Product Stock: </strong><?php echo $singleProduct->productStock; ?></li>
    <li><strong>Product Provider: </strong><?php echo $singleProduct->productProvider; ?></li>
  </ul>




<?php include 'inc/footer.php';?>
