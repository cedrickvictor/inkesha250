<?php include('design/menu.php'); ?>
<?php include('design/connect.php'); ?>

<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);



?>
<!-- main section starts -->

<div class="main">
    <div class="wrapper">
	     <h1> DASHBOARD </h1>
	     <div>
	     	<br>
Hello, <?php echo $user_data['username']; ?>
	</div>
	    <br><br>
            

	     <div class="col-4 foot">
	     	<?php
	     	// sql
	     	$sql = "select * from category";
	     	// execute query
	     	$result = mysqli_query($con,$sql);
	     	// count rows
	     	$count = mysqli_num_rows($result);
	     	?>
	     	<h1><?php echo $count; ?></h1>
	     	Categories
	     </div>

	     <div class="col-4 foot">
	     	<?php
	     	// sql
	     	$sql1 = "select * from food";
	     	// execute query
	     	$result1 = mysqli_query($con,$sql1);
	     	// count rows
	     	$count1 = mysqli_num_rows($result1);
	     	?>
	     	<h1><?php echo $count1; ?></h1>
	     	Foods
	     </div>

	     <div class="col-4 foot">
	     	<?php
	     	// sql
	     	$sql2 = "select * from tbl_order";
	     	// execute query
	     	$result2 = mysqli_query($con,$sql2);
	     	// count rows
	     	$count2 = mysqli_num_rows($result2);
	     	?>
	     	<h1><?php echo $count2; ?></h1>
	     	Total Orders
	     </div>

	     <div class="col-4 foot">
	     	<?php
	     	// aggregated function and sql
	     	$query = "SELECT SUM(total) AS total FROM tbl_order WHERE status='delivered'";
	     	// execute query
	     	$res = mysqli_query($con,$query);
	     	// get the value
	     	$row = mysqli_fetch_assoc($res);
	     	// get the total revenue
	     	$total_revenue = $row['total'];
	     	?>
	     	<h1><?php echo $total_revenue; ?></h1>
	     	Revenue Generated
	     </div>

	     <div class="clearfix"></div>
	</div>
</div>

<!-- main section ends -->

<?php include('design/footer.php'); ?>
