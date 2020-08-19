<?php include '../inc/headerUser.php';?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #333;
  color:white;
}
</style>
<br><br>



<h1>User Information</h1>

<br><br>

<ul>
  <li><strong>User Name: </strong><?php echo $users->userName; ?></li>
  <li><strong>User Address: </strong><?php echo $users->userAddress; ?></li>
</ul>

<br><br>
<h2>Orders History</h2>
<br>
<table>
  <tr>
    <th>Product Name</th>
    <th>Product Price</th>
    <th>Number Of Products</th>
    <th>Delivery Method</th>
    <th>Total Payment</th>
    <th>Order Date</th>
  </tr>
    <?php foreach($orders as $order): ?>
        <tr>
      <td><?php echo $order->productName;?></td>
      <td><?php echo $order->productPrice; ?></td>
      <td><?php echo $order->customerNumberWatches; ?></td>
      <td><?php echo $order->deliveryMethod; ?></td>
      <td><?php echo $order->totalPayment; ?></td>
      <td><?php echo $order->orderDate; ?></td>
        </tr>
    <?php endforeach; ?>


</table>



<br><br><br>
<a href="logoutIndex.php" class="searchButton">Logout</a>

<?php include '../inc/footer.php';?>
