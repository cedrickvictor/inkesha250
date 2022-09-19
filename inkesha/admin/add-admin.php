<?php
include('design/menu.php');
?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);



?>
<div class="wrapper">
	<h1> Admin Form</h1>

	<form action="" method="POST">
		<label>Full Name: </label><input type="text" name="name" placeholder="Enter Your Full Name"><br>
		<label>Username: </label><input type="text" name="username" placeholder="Enter Your Username"><br>
		<label>Password: </label><input type="password" name="password" placeholder="Enter Your Password" required><br>
		<button class="btn-primary" value="add-admin" type="submit" name="submit">Add Admin</button>
	</form>
	
</div>

<?php
include('design/footer.php');
?>

<?php
require_once('design/connect.php');

if(isset($_POST['submit']))
{
	// Button clicked
	// 1.Get data from Form
		$full_name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];  // Encrypt password with MDS

	// 2.SQL query to save the data into database


		$query = "insert into admin (full_name,username,password) values ('$full_name','$username','$password')";
    
    // 3. Executing query and saving Data in database

		$result = mysqli_query($con,$query);
		
	// 4. check whether the data is inserted or not and display approppriate message

			if($result)
			{
				
				 header('location:admin.php');
			}
			else
			{
				echo' Fail to Insert Data';
			}	
}


?>