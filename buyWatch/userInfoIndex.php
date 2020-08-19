<?php include_once 'config/init.php'; ?>

<?php

$template = new Template('templates/userViews/userInfo.php');

$user = new User;
$order = new Orders;

$template->users = $user->getUser($_SESSION['user_id']);
$template->orders = $order->getOrderForUser($_SESSION['user_id']);



echo $template;
