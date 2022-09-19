<?php require_once('design/connect.php')?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);



?>
<?php

$id = $_GET['id'];

$query = "DELETE FROM admin WHERE id=$id";
$result = mysqli_query($con, $query);
if($result){
	 
	 header('location: admin.php');
	 echo 'Successfully Deleted';
}
else{
     echo 'Fail to Delete';
	
}
?>