<?php include('design/menu.php'); ?>


<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);
?>

<?php require_once('design/connect.php')?>

<!-- main section starts -->

<div class="main">
    <div class="wrapper">
	     <h1> Manage Admin </h1>

	     <button class="btn-primary"><a href="add-admin.php"> Add Admin</button></a>

	     <table class="content">
	     	<tr>
	     		<th>Number</th>
	     		<th>Full Name</th>
	     		<th>Username</th>
	     		<th>Password</th>
	     		<th>Actions</th>
	     	</tr>

	     	<?php 
	     	//Query to fetch data from database
	     	$query = "SELECT * FROM admin";
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
	     				$full_name=$rows['full_name'];
	     				$username=$rows['username'];
	     				$password=$rows['password'];

	     				//display the values in our table
	     				?>

			     	<tr>
				     	<td><?php echo $sn++; ?></td>
				     	<td><?php echo $full_name; ?></td>
				     	<td><?php echo $username; ?></td>
				     	<td><?php echo $password; ?></td>
				     	<td>
				     	<a href="update.php?id=<?php echo $id; ?>"><button class="btn-secondary"> Update Admin</button></a>
				     	<a href="delete-admin.php?id=<?php echo $id; ?>"><button class="btn-danger"> Delete Admin</button></a>

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

<?php include('design/footer.php'); ?>

