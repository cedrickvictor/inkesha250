<?php
require_once('design/connect.php');
?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);



?>
<?php
include('design/menu.php');
?>

<?php

$id = $_GET['id'];
$query = "select * from admin where id='".$id."'";
$result = mysqli_query($con,$query);

while($row=mysqli_fetch_assoc($result))

                    {
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                        $password = $row['password'];
                    }

?>

<div class="wrapper">
	<h1> Update Form</h1>

	<form action="" method="POST">
		<label>Full Name: </label><input type="text" name="full_name" value="<?php echo $full_name ?>"><br>
		<label>Username: </label><input type="text" name="username" value="<?php echo $username ?>"><br>
		<label>Password: </label><input type="text" name="password" value="<?php echo $password ?>"  required><br>
		<button class="btn-primary" value="update-admin" type="submit" name="update">Update</button>
	</form>
	
</div>

<?php

require_once('design/connect.php');

if(isset($_POST['update']))
{
	$id =$_GET['id'];
	$full_name =$_POST['full_name'];
	$username =$_POST['username'];
	$password =$_POST['password'];

	$query = " update admin set full_name= '".$full_name."', username='".$username."', password= '".$password."'where id= '".$id."'";
	$result = mysqli_query($con,$query);

	if($result)
	{
		header("location:admin.php");
	}

	else
	{
		echo' Please Check Your Query';
	}
}
?>


<?php
include('design/footer.php');
?>
