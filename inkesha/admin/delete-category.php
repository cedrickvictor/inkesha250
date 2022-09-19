<?php require_once('design/connect.php')?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);



?>
<?php

if (isset($_GET['id'])) 
{
	// get the value and delete it
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];

	// remove the physical image file is available

	if ($image_name != "") 
	{
		// image is available.... so
		$path = "../img/category/".$image_name;
		// remove it 
		$remove = unlink($path);

		// if is failed  add an error message

		if ($remove==false) 
		{
			$_SESSION['remove'] = "<div> fail to remove the picture </div>";
			header('location: category.php');
			die();
		}
	}

	// delete it from database
	$query = "DELETE FROM category WHERE id=$id";
// execute query
	$result =mysqli_query($con,$query);

	
	if ($result==true) 
	{
		$_SESSION['delete'] = "<div style='color:red'>successfully deleted </div>";
	    header('location:category.php');

	}
else
{
	$_SESSION['delete'] = "<div style='color:darkred'> deleted failed </div>";
	header('location:category.php');
}
}
else{
	header('location:category.php');
}
?>