<?php include 'inc/header.php';?>
<script>
  $(document).ready(function(){
    $("#submit").click(function(){

      var productName = $("#productName").val();
      var productDescription = $("#productDescription").val();
      var productSpecs = $("#productSpecs").val();
      var productPrice = $("#productPrice").val();
      var productCount = $("#productCount").val();
      var productStock = $("#productStock").val();
      var productProvider = $("#productProvider :selected").val();
      var productCategory = $("#productCategory :selected").val();
      var deliveryMethod = $("#deliveryMethod :selected").val();


      if( productName != ""){
          $.ajax({
              url:'addWatchIndex.php',
              type:'post',
              data:{
                productName:productName,
                productCategory:productCategory,
                productDescription:productDescription,
                productSpecs:productSpecs,
                productPrice:productPrice,
                productCount:productCount,
                productStock:productStock,
                productProvider:productProvider,
                deliveryMethod:deliveryMethod,
                do_login:1
              },
              success:function(response){
                  var msg = "";
                  if(response == 1){
                      msg = "Watch Added!";
                      $("#productName").val('');
                      $("#productCategory").val(0);
                      $("#productDescription").val('');
                      $("#productSpecs").val('');
                      $("#productPrice").val('');
                      $("#productCount").val('');
                      $("#productStock").val('');
                      $("#productProvider").val(0);
                      $("#deliveryMethod").val(0);
                  }else if(response == 0){
                      msg = "Something went wrong!";
                  }else if(response == 3){
                    msg = "Fill not correct!";
                  }else{
                    msg = "asd";
                  }
                  $("#message").html(msg);
              }
          })
      }
  });
});
</script>
<br><br><br><br>
<div class="insert">
<h2 class="header">Add A Watch</h2>
</div>
<!--  <form method="post" action="addWatchIndex.php"> -->
<div class="insert">
  <label>Watch Name</label>
  <input type="text" class="form-control" name="productName" id="productName"
    placeholder="Name">
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
    <textarea type="text" placeholder="Describe product" class="form-control" name="productDescription" id="productDescription"></textarea>
  </div>
  <div class="insert">
    <label>Product Specifications</label>
    <textarea type="text" placeholder="Specifications of the product" class="form-control" name="productSpecs" id="productSpecs"></textarea>
  </div>
  <div class="insert">
    <label>Product Price</label>
    <input type="text" class="form-control" name="productPrice" id="productPrice"
        placeholder="Price">
  </div>
  <div class="insert">
    <label>Product Count</label>
    <input type="text" class="form-control" name="productCount" id="productCount"
        placeholder="Count">
  </div>
  <div class="insert">
    <label>Product Stock</label>
    <input type="text" class="form-control" name="productStock" id="productStock"
        placeholder="Stock">
  </div>
  <!--<div class="insert">
    <label>Product Provider</label>
    <input type="text" class="form-control" name="productProvider" id="productProvider"
        placeholder="Provider">
  </div>-->
    <div class="insert">
      <label>Choose Provider</label>
      <select class="form-control" name="productProvider" id="productProvider">
          <option value="0">Select Provider</option>
          <option value="1">Emag</option>
          <option value="2">Alibaba</option>
          <option value="3">Amazon</option>
          <option value="4">Ebay</option>
          <option value="5">TopWatch</option>
          </option>
      </select>
  </div>
    <div class="insert">
      <label>Delivery Method</label>
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
  <input type="submit" class="button" value="Submit" name="submit" id="submit">
  </div>
<!--</form> -->
  <p id="message"></p>

<?php include 'inc/footer.php';?>
