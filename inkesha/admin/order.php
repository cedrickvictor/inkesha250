<?php include('design/menu.php') ?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);

?>
<!-- main section starts -->

<div class="main">
    <div class="wrapper">
	     <h1> Manage Order </h1>
<?php
if(isset($_SESSION['update'])){
	echo $_SESSION['update'];
	unset ($_SESSION['update']);
}
?>
	     <table class="content">
	     	<tr>
	     		<th>S.N</th>
	     		<th>Food </th>
	     		<th>Price</th>
	     		<th>Quantity</th>
	     		<th>Total</th>
	     		<th>Date</th>
	     		<th>Status</th>
	     		<th>Customer Names</th>
	     		<th>Contact</th>
	     		<th>Email</th>
	     		<th>Address</th>
	     		<th>Action</th>
	     	</tr>

	     	<?php

	     	// get all orders from database
	     	$sql = "select * from tbl_order order by id DESC";

	     	$result = mysqli_query($con,$sql);

	     	$count = mysqli_num_rows($result);
	     	$sn = 1; // display numberings

	     	if($count>0)
	     		{
	     			while ($row=mysqli_fetch_assoc($result)) {
	     				$id = $row['id'];
	     				$food = $row['food'];
	     				$price = $row['price'];
	     				$qty = $row['qty'];
	     				$total = $row['total'];
	     				$order_date = $row['order_date'];
	     				$status = $row['status'];
	     				$customer_name = $row['customer_name'];
	     				$customer_contact = $row['customer_contact'];
	     				$customer_email = $row['customer_email'];
	     				$customer_address = $row['customer_address'];
	     				?>
	     				<tr>
	     	<td><?php echo $sn++; ?></td>
	     	<td><?php echo $food; ?></td>
	     	<td><?php echo $price; ?></td>
	     	<td><?php echo $qty; ?></td>
	     	<td><?php echo $total; ?></td>
	     	<td><?php echo $order_date; ?></td>
	     	<td><?php echo $status; ?></td>
	     	<td><?php echo $customer_name; ?></td>
	     	<td><?php echo $customer_contact; ?></td>
	     	<td><?php echo $customer_email; ?></td>
	     	<td><?php echo $customer_address; ?></td>
	     	<td>
	     	<a href="update-order.php?id=<?php echo $id; ?>"><button class="btn-secondary"> Update Order</button></a>

	     	</td>
	     	</tr>
	     				<?php
	     			}
	     		}
	     		else
	     		{
	     			// order not available
	     			echo "<tr><td colspan='12 class='error'> Orders not Available</td></tr>";
	     		}

	     	?>

            


	     </table>
	     <div class="clearfix"></div>
	</div>
</div>

<!-- main section ends -->


<?php include('design/footer.php') ?>