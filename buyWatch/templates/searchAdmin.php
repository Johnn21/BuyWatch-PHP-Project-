<?php include 'inc/header.php';?>

<br><br>
<div class="search-box">
  <h4 class="search-title">Search Watch</h4>
  <br>
  <br>
  <form method="GET" action="searchAdminIndex.php">
    <input id="myInput" type="text" placeholder="Search.." name="myInput"/>
  <br><br>
    <select class="select" name ="categorySelect">
      <option value="0">Choose Category</option>
      <?php foreach($categories as $category): ?>
        <option value="<?php echo $category->categoryId; ?>">
          <?php echo $category->categoryName; ?></option>
      <?php endforeach; ?>
    </select>
      <br><br>
      <select class="select" name ="sortAfterPrice">
        <option value="0">Sort After Price</option>
        <option value="1">Ascending Order</option>
        <option value="2">Descending Order</option>
      </select>
      <br><br>
      <select class="select" name ="chooseProvider">
        <option value="0">Choose Provider</option>
        <option value="1">Emag</option>
        <option value="2">Alibaba</option>
        <option value="3">Amazon</option>
        <option value="4">Ebay</option>
        <option value="5">TopWatch</option>
      </select>
      <br><br>
      <select class="select" name ="chooseMethod">
        <option value="0">Choose Delivery Method</option>
        <option value="1">To Our Showroom</option>
        <option value="2">To Your Home</option>
        <option value="3">Both</option>
      </select>
      <br><br>
      <input type="checkbox" name="inStock"  unchecked>
      <label for="inStock">In Stock</label>
        <br><br>
        <input type="submit" class="searchButton" value="FIND">
  </form>
</div>
  <h3><?php echo $title; ?></h3>
  <br><br>
<div id="myDIV">
    <?php foreach ($products as $product): ?>
      <div class="watches-description">
          <h4><?php echo $product->productName; ?></h4>
          <p><?php echo $product->productDescription; ?></p>
          <div class="col-md-2">
              <a class="searchButton" href="singleProductIndexAdmin.php?id=<?php echo $product->productId; ?>" >View</a>
                <br><br>
              <a class="searchButton" href="editProductsIndex.php?id=<?php echo $product->productId; ?>" >Edit</a>
                <br><br>
        </div>

      </div>
      <?php endforeach; ?>
</div>



<?php include 'inc/footer.php';?>
