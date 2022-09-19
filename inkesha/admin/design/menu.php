<?php
include('design/connect.php');
// authorasation or access control 
// if (!isset($_SESSION['user']))  // user is not logged in
// {
//	$_SESSION['no-login-message'] = "<div>please login to access admin panel</div>";
//	header('location:login.php');
// }
// ?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Homepage</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/inkesha.jpeg">
    <title>Inkesha Ltd</title>
</head>
<body>

<!-- menu section starts -->

<div class="menu">
	<div class="wrapper">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="admin.php">Admin</a></li>
			<li><a href="category.php">Category</a></li>
			<li><a href="food.php">Food</a></li>
			<li><a href="order.php">Order</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</div>