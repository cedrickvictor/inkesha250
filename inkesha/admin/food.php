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
	     <h1> Manage Food </h1>
<?php
if(isset($_SESSION['add'])){
	echo $_SESSION['add'];
	unset ($_SESSION['add']);
}
?>
	     	<button class="btn-primary"><a href="add-food.php"> Add Food</button></a>

	     
	     <table class="content">
	     	<tr>
	     		<th>Number</th>
	     		<th>Title</th>
	     		<th>Price</th>
	     		<th>Image</th>
	     		<th>Featured</th>
	     		<th>Active</th>
	     		<th>Action</th>
	     	</tr>

	     	<?php 
	     	//Query to fetch data from database
	     	$query = "SELECT * FROM food";
	     	//execute the query

	     	$result = mysqli_query($con,$query);

	     	// check whether the query is executed or not 
	     	if($result)
	     	{
	     		// count rows
	     		$rows = mysqli_num_rows($result); // function to get all rows in database

	     		$sn=1; // create variable and assign values
	     		if($rows>0)
	     		{
	     			// we have data in database
	     			while($rows=mysqli_fetch_assoc($result))
	     			{
	     				// using while loop to get all the data from database.
	     				//and while loop will run as long as we have data in database

	     				//get individual data
	     				$id=$rows['id'];
	     				$title=$rows['title'];
	     				$price=$rows['price'];
	     				$image_name=$rows['image_name'];
	     				$featured=$rows['featured'];
	     				$active=$rows['active'];

	     				//display the values in our table
	     				?>

			     	<tr>
				     	<td><?php echo $sn++; ?></td>
				     	<td><?php echo $title; ?></td>
				     	<td><?php echo $price; ?> $</td>
				     	<td>
				     	<?php 
				     	// check whether image name is available
				     	if ($image_name!="") 
				     	{
				     		// display image
				     		?>
				     		<img src="../img/food/<?php echo $image_name; ?>" width="100px">
				     		<?php

				     	}
				     	else
				     	{
				     		echo "<div style=color:red>image not added</div>";
				     	}
				     	?>
				     	</td>
				     	<td><?php echo $featured; ?></td>
				     	<td><?php echo $active; ?></td>
				     	<td>
				     	<a href="update-food.php?id=<?php echo $id; ?>"><button class="btn-secondary"> Update Food</button></a>
				     	<a href="delete-food.php?id=<?php echo $id; ?>"><button class="btn-danger"> Delete Food</button></a>

				     	</td>
			     	</tr>

	     				<?php
	     			}

	     		}
	     		else{
	     			// we do not have data in database
	     		}

	     	}

	     	?>

	     </table>
	     <div class="clearfix"></div>
	</div>
</div>

<!-- main section ends -->


<?php include('design/footer.php') ?>