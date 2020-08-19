<?php include 'inc/header.php';?>
<script>
  $(document).ready(function(){
    $("#submit").click(function(){

      var productName = $("#productName").val();
      var productDescription = $("#productDescription").val();
      var productCategory = $("#productCategory :selected").val();
      var productSpecs = $("#productSpecs").val();
      var productPrice = $("#productPrice").val();
      var productCount = $("#productCount").val();
      var productStock = $("#productStock").val();
      var productProvider = $("#productProvider").val();
      var deliveryMethod = $("#deliveryMethod :selected").val();

      var productId = $("#var").val();

      if( productName != ""){
          $.ajax({
              url:'editProductsIndex.php',
              type:'post',
              data:{
                productName:productName,
                productCategory:productCategory,
                productDescription:productDescription,
                productSpecs:productSpecs,
                productPrice:productPrice,
                productCount:productCount,
                productStock:productStock,
                productId:productId,
                productProvider:productProvider,
                deliveryMethod:deliveryMethod,
                do_login:1
              },
              success:function(response){
                  var msg = "";
                  if(response == 1){
                      msg = "Watch Edited!";
                  }else if(response == 0){
                      msg = "Something went wrong!";
                  }else{
                    msg = "atlc";
                  }
                  $("#message").html(msg);
              }
          });
      }
  });
});
</script>
<br><br><br><br>
<div class="insert">
<h2 class="header">Edit Watch</h2>

</div>
<!--  <form method="post" action="addWatchIndex.php"> -->
<div class="insert">
  <input type="hidden" class="form-control" name="productName" id="var"
    placeholder="Name" value="<?php echo $products->productId; ?>">
  <label>Watch Name</label>
  <input type="text" class="form-control" name="productName" id="productName"
    placeholder="Name" value="<?php echo $products->productName; ?>">
</div>
<div class="insert">
  <label>Watch Category</label>
  <select class="form-control" name="productCategory" id="productCategory">
      <option value="0">Select Category</option>
        <?php foreach($categories as $category): ?>
          <option value="<?php echo $category->categoryId; ?>"><?php echo
            $category->categoryName; ?></option>
        <?php endforeach; ?>
      </option>
  </select>
</div>
  <div class="insert">
    <label>Description</label>
    <textarea type="text" placeholder="Describe product" class="form-control" name="productDescription" id="productDescription"><?php echo $products->productDescription; ?></textarea>
  </div>
  <div class="insert">
    <label>Product Specifications</label>
    <textarea type="text" placeholder="Specifications of the product" class="form-control" name="productSpecs" id="productSpecs"><?php echo $products->productSpecs; ?></textarea>
  </div>
  <div class="insert">
    <label>Product Price</label>
    <input type="text" class="form-control" name="productPrice" id="productPrice"
        placeholder="Price" value="<?php echo $products->productPrice; ?>">
  </div>
  <div class="insert">
    <label>Product Count</label>
    <input type="text" class="form-control" name="productCount" id="productCount"
        placeholder="Count" value="<?php echo $products->productCount; ?>">
  </div>
  <div class="insert">
    <label>Product Stock</label>
    <input type="text" class="form-control" name="productStock" id="productStock"
        placeholder="Stock" value="<?php echo $products->productStock; ?>">
  </div>
  <div class="insert">
    <label>Product Provider</label>
    <input type="text" class="form-control" name="productProvider" id="productProvider"
        placeholder="Provider" value="<?php echo $products->productProvider; ?>">
  </div>
  <div class="insert">
    <select class="form-control" name="deliveryMethod" id="deliveryMethod">
        <option value="0">Select Method</option>
        <option value="1">To Our Showroom</option>
        <option value="2">To Your Home</option>
        <option value="3">Both</option>
        </option>
    </select>
  </div>
  <br><br><br>
  <div class="insert">
  <input type="submit" class="searchButton" value="Submit" name="submit" id="submit">
  <form style="display:inline;" method="POST" action="editProductsIndex.php">
    <input onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="searchButton" value="Delete" id="delete">
    <input type="hidden" name="del_id" value="
      <?php echo $products->productId; ?>" id="del_id">
  </form>
  </div>
<!--</form> -->
  <p id="message"></p>


<?php include 'inc/footer.php';?>
