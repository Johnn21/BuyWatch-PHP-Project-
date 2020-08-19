<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register User</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" text="text/css" href="css/navbar.css?version=51">
    <link rel="stylesheet" text="text/css" href="css/styles.css?version=51">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#submit").click(function(){

          var userName = $("#userName").val();
          var userPassword = $("#userPassword").val();
          var userPasswordConfirmation = $("#userPasswordConfirmation").val();
          var userAddress = $("#userAddress").val();
          var userCardName = $("#userCardName").val();
          var userCardPassword = $("#userCardPassword").val();
          var userCardPasswordConfirmation = $("#userCardPasswordConfirmation").val();
          var userMoney = $("#userMoney").val();

          if( userName != ""){
              $.ajax({
                  url:'registerIndex.php',
                  type:'POST',
                  data:{
                    userName:userName,
                    userPassword:userPassword,
                    userPasswordConfirmation:userPasswordConfirmation,
                    userAddress:userAddress,
                    userCardName:userCardName,
                    userCardPassword:userCardPassword,
                    userCardPasswordConfirmation:userCardPasswordConfirmation,
                    userMoney:userMoney,
                    do_register:1
                  },
                  success:function(response){
                      var msg = "";
                      if(response == 1){
                          msg = "You are now registered!";
                          $("#userName").val('');
                          $("#userPassword").val('');
                          $("#userPasswordConfirmation").val('');
                          $("#userAddress").val('');
                          $("#userCardName").val('');
                          $("#userCardPassword").val('');
                          $("#userCardPasswordConfirmation").val('');
                          $("#userMoney").val("");
                      }else if(response == 2){
                          msg = "Something went wrong!";
                      }else if(response == 3){
                        msg = "Password not matching!";
                      }else if(response == 4){
                        msg = "Password card not matching!";
                      }else if(response == 5){
                        msg = "Fill all the fields!";
                      }else if(response == 6){
                        msg = "Please enter just numbers"
                      }else if(response == 7){
                        msg = "Your bank data is invalid";
                      }
                      $("#message").html(msg);
                  }
              });
          }
      });
    });
    </script>
  </head>
  <body>
    <br><br>
    <div class="insert">
    <h2 class="header">Register Here!</h2>
    </div>
    <!--  <form method="post" action="addWatchIndex.php"> -->
    <div class="insert">
      <label>Name</label>
      <input type="text" class="form-control" name="userName" id="userName"
        placeholder="Enter Name">
    </div>
    <div class="insert">
      <label>Password</label>
      <input type="password" class="form-control" name="userPassword" id="userPassword"
        placeholder="Enter Password">
    </div>
    <div class="insert">
      <label>Confirm Password</label>
      <input type="password" class="form-control" name="userPasswordConfirmation" id="userPasswordConfirmation"
        placeholder="Enter Password Again">
    </div>
    <div class="insert">
      <label>Address</label>
      <input type="text" class="form-control" name="userAddress" id="userAddress"
        placeholder="Enter Address">
    </div>
    <div class="insert">
      <label>Card Name</label>
      <input type="text" class="form-control" name="userCardName" id="userCardName"
        placeholder="Enter Card Name">
    </div>
    <div class="insert">
      <label>Card Password</label>
      <input type="password" class="form-control" name="userCardPassword" id="userCardPassword"
        placeholder="Enter Card Password">
    </div>
    <div class="insert">
      <label>Card Password Confirmation</label>
      <input type="password" class="form-control" name="userCardPasswordConfirmation" id="userCardPasswordConfirmation"
        placeholder="Enter Card Password Confirmation">
    </div>
    <div class="insert">
      <label>Allocate A Sum</label>
      <input type="text" class="form-control" name="userMoney" id="userMoney"
        placeholder="Enter A Sum">
    </div>
      <div class="insert">
      <input type="submit" class="button" value="Submit" name="submit" id="submit">
      </div>
    <!--</form> -->
      <p id="message"></p>
  </body>
</html>
