<?php include '../inc/headerUser.php';?>
<script>
  $(document).ready(function(){
    $("#submit").click(function(){
      var customerName = $("#customerName").val();
      var customerAddress = $("#customerAddress").val();
      var customerPhone = $("#customerPhone").val();
      var customerCardName = $("#customerCardName").val();
      var customerCardPassword = $("#customerCardPassword").val();
      var customerNumberWatches = $("#customerNumberWatches").val();
      var deliveryMethod = $("#deliveryMethod :selected").val();
      var payMethod = $("#payMethod :selected").val();
      var productId = $("#var").val();

      if( customerName != ""){
          $.ajax({
              url:'buyIndex.php',
              type:'post',
              data:{
                customerName:customerName,
                customerAddress:customerAddress,
                customerPhone:customerPhone,
                customerCardName:customerCardName,
                customerCardPassword:customerCardPassword,
                customerNumberWatches:customerNumberWatches,
                productId:productId,
                deliveryMethod:deliveryMethod,
                payMethod:payMethod,
                do_buy:1
              },
              success:function(response){
                  var msg = "";
                  if(response == 1){
                      msg = "Order Added!";
                      $("#customerName").val('');
                      $("#customerAddress").val('');
                      $("#customerPhone").val('');
                      $("#customerNumberWatches").val('');
                      $("#deliveryMethod").val(0);
                      $("#customerNumberWatches").val('');
                      $("#payMethod").val(0);
                      $("#customerCardName").val("");
                      $("#customerCardPassword").val("");

                  }else if(response == 3){
                      msg = "Invalid Bank Bata";
                  }else if(response == 4){
                      msg = "Invalid Input!"
                  }else if(response == 5){
                      msg = "There Are Not So Many Watches :( !";
                  }else if(response == 6){
                      msg = "You Don`t Have So Much Money!";
                  }else if(response == 7){
                      msg = "We Can Not Deliver The Watch To Your Home :( !";
                  }else if(response == 8){
                      msg = "The Watch Is Not Available In The Showroom :( !";
                  }else{
                      msg = "Something Went Wrong!"
                  }
                  $("#message").html(msg);

              }
          });
      }
  });
    $("#customerNumberWatches").change(function(){
        var customerNumberWatches = $(this).val();
        var price = <?php echo $products->productPrice; ?>;

      $("#deliveryMethod").change(function(){
         var method = $("#deliveryMethod :selected").val();
         if(method == 1){
           var cv = 15;
         }else{
           var cv = 0;
         }
         var result = customerNumberWatches * price + cv;
               $("#totalPrice").html(result);
      });

    });
  $("#payMethod").change(function(){
      var method = $(this).val();

      if(method == 1){
        $("#payWithCard").show();
      }else{
        $("#payWithCard").hide();
      }

  });
});
</script>

<br><br>
<input type="hidden" class="form-control" name="productName" id="var"
  placeholder="Name" value="<?php echo $products->productId; ?>">
<div class="buy-field">
<label>Your Name</label>
<input type="text" class="form-control" placeholder="Enter Name" name="customerName" id="customerName"/>
<label>Your Address</label>
<input type="text" class="form-control" placeholder="Enter Address" name="customerAddress" id="customerAddress"/>
<label>Your Phone Number</label>
<input type="text" class="form-control" placeholder="Enter Phone NUmber" name="customerPhone" id="customerPhone"/>
<label>Number Of Watches</label>
<input type="text" class="form-control" placeholder="Enter The Number Of Watches You Want To Buy" name="customerNumberWatches" id="customerNumberWatches"/>
<br>
<label>Delivery Method</label>
<select class="select" name ="methodSelect" id="deliveryMethod">
  <option value="0">Choose Method</option>
  <option value="1">To Your Home</option>
  <option value="2">To Our Showroom</option>
</select>
<label>Pay Method</label>
<select class="select" name ="payMethod" id="payMethod">
  <option value="0">Choose Method</option>
  <option value="1">With Card</option>
  <option value="2">With Cash</option>
</select>
<div id="payWithCard" style="display:none">
  <label>Card Name</label>
  <input type="text" class="form-control" placeholder="Enter Card Name" name="customerCardName" id="customerCardName"/>
  <label>Card Password</label>
  <input type="password" class="form-control" placeholder="Enter Card Password" name="customerCardPassword" id="customerCardPassword"/>
</div>
<p>Total Price:</p>
<p id ="totalPrice"></p>
<br>
<input type="submit" class="searchButton" value="Submit" name="submit" id="submit">

<p id ="message"></p>
</div>



<?php include '../inc/footer.php';?>
