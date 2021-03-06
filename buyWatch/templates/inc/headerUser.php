<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WatchShop</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" text="text/css" href="css/navbar.css?version=51">
    <link rel="stylesheet" text="text/css" href="css/styles.css?version=51">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a class="active" href="frontpageUserIndex.php">Home</a></li>
        <li><a class="active" href="searchIndex.php">Search Watches</a></li>
        <li style="float:right"><a class="active" href="addFavoriteIndex.php">Your Cart</a></li>
        <li style="float:right"><a href="userInfoIndex.php">Hello, <?php echo $_SESSION['user_info']; ?></a></li>
      </ul>
    </div>
