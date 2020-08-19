<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" text="text/css" href="css/login.css?version=51">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#submit").click(function(){
          var username = $("#username").val().trim();
          var password = $("#password").val().trim();

          if( username != "" && password != "" ){
              $.ajax({
                  url:'index.php',
                  type:'post',
                  data:{
                    username:username,
                    password:password,
                    do_login:1
                  },
                  success:function(response){
                      var msg = "";
                      if(response == 1){
                          window.location = "frontpageIndex.php";
                      }else if(response == 2){
                          window.location = "frontpageUserIndex.php";
                      }else{
                        msg = "Username or password wrong!";
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

    <div class="frm">
        <p>
          <label>Username:</label>
          <input type="text" id="username" name="username">
        </p>
        <p>
          <label>Password:</label>
          <input type="password" id="password" name="password">
        </p>
        <button type="submit" name="submit" id="submit">Login</button>
        <a href="registerIndex.php">Don`t have an account?Register Now!</a>

        <p id="message"></p>

    </div>
  </body>
</html>
