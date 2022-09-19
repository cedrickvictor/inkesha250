<?php

session_start();

    include("design/connect.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username =$_POST['username'];
        $password =$_POST['password'];


        if(!empty($username) && !empty($password) && !is_numeric($username))

        {
            
            $query = "select * from admin where username = '$username' limit 1";
            $result = mysqli_query($con,$query);
            if($result)
            {
                if ($result && mysqli_num_rows($result) > 0) 
    {
        $user_data = mysqli_fetch_assoc($result);
        if($user_data['password'] === $password)
        {
            $_SESSION['id'] = $user_data['id'];
            header("location: index.php");
            die;
        } 
        
    }
}
        echo "<div class='error'> username and password did not match. </div>";   
    }
}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <style>
*{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;  
}
body{
    background-color: gainsboro;
}
.wrapper{
    padding-top: 10%;
    margin-top: 40px;
    width: 200%;
    position: absolute;
}
.form-box{
    width: 470px;
    height: 450px;
    position: relative;
    margin: 6% auto;
    background-color: beige;
    padding: 5px;
}
#btn{
    top: 0;
    left: 0;
    position: absolute;
    width: 110px;
    height: 35px;
    border-radius: 30px;
    transition: .5s;
}
.input-group{
    top: 100px;
    position: absolute;
    width: 280px;
    transition: .5s;
}
.input-field{
    width: 100%;
    padding: 10px 0;
    margin: 10px 0;
    border-left: 0;
    border-top: 0;
    border-right: 0;
    border-bottom: 1px solid #999;
    outline: none;
    background: transparent;
}
.submit-btn{
    width: 100%;
    padding: 10px 30px;
    cursor: pointer;
    display: block;
    margin-top: 30px;
    border: 0;
    outline: none;
    border-radius: 30px;
    background-color: goldenrod;
}
.submit-btn:hover{
    background: orange;

}
.check-box{
    margin: 30px 10px 30px 0;
}


#login{
    left: 100px;
}
    </style>
    <div class="head">
        <div class="form-box">
            <br> 
                <form id="login" class="input-group" method="POST" action="login.php">
                <h1> Admin Panel</h1>

                <input type="text" class="input-field" placeholder="Enter Your Username" name="username" required>
                <input type="password" class="input-field" placeholder="Enter Your Password" name="password" required>
                <button type="submit" class="submit-btn" name="login" value="login"> Login </button>
                <br>

                <div class="wrapper">
                <p>2022 All Right Reserved, Inkesha Ltd.</p>
                </div>

                </form>
                
            </div>
        
        </div>

<?php
include('design/connect.php');
if(isset($_POST['login'])){
$username= mysqli_real_escape_string($con, $_POST['username']);
$password= mysqli_real_escape_string($con, md5($_POST['password']));


$sql="SELECT * FROM admin WHERE Username='$username' AND Password='$password'";
$result=mysqli_query($con,$sql);
$row=mysqli_num_rows($result);
if($row==1)
{
    // login success

    $_SESSION['login']="<div class='success'> successfully logged in. </div>";
	$_SESSION['username']= $username;
	header('location:index.php');
}
else
{
	$_SESSION['login'];
    header('location:login.php');
}
}
?>