<?php include '../inc/headerUser.php';?>

<br><br>

<h1>Your favorite watches!</h1>

<br><br>

<div id="myDIV">
    <?php foreach ($products as $product): ?>
      <div class="watches-description">
          <h4><?php echo $product->productName; ?></h4>
          <p><?php echo $product->productDescription; ?></p>
          <div class="col-md-2">
              <a class="searchButton" href="buyIndex.php?id=<?php echo $product->productId; ?>" >Buy</a>
              <br><br>
        </div>
      </div>
      <?php endforeach; ?>
</div>

<?php include '../inc/footer.php';?>
