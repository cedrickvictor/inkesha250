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
$query = "select * from tbl_order where id='".$id."'";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);

if($count==1)
{
$rows=mysqli_fetch_assoc($result);     
$food=$rows['food'];
$price=$rows['price'];
$qty=$rows['qty'];
$total =$price * $qty;
$order_date=$rows['order_date'];
$status=$rows['status'];
$customer_name=$rows['customer_name'];
$customer_contact=$rows['customer_contact'];
$customer_email=$rows['customer_email'];
$customer_address=$rows['customer_address'];
}

?>

<div class="wrapper">
    <h1> Update Order Form</h1><br>

    <form action="" method="POST">
        <label>Food </label><input type="text" name="food" value="<?php echo $food; ?>"><br><br>
        <label>Price: </label><input type="text" name="price" value="<?php echo $price; ?>"><br><br>
        <label>Quantity: </label><input type="text" name="qty" value="<?php echo $qty; ?>"><br><br>
        <label>Total: </label><input type="text" name="total" value="<?php echo $total; ?>"><br><br>
        <label>Order Date: </label><input type="text" name="order_date" value="<?php echo $order_date; ?>"><br><br>
    
        <label>Select Food Status: </label>
        <select name="status">
            <option value="ordered">Ordered</option>
            <option value="on delivery">On Delivery</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
        </select><br><br>
        <label>Customer name: </label><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"><br><br>
        <label>Customer contact: </label><input type="telephone" name="customer_contact" value="<?php echo $customer_contact; ?>"><br><br>
        <label>Customer email: </label><input type="email" name="customer_email" value="<?php echo $customer_email; ?>"><br><br>
        <label>Customer Address: </label><input type="text" name="customer_address" value="<?php echo $customer_address; ?>"><br><br>
        
        <button class="btn-primary" value="update-order" type="submit" name="update">Update Order</button>
</form>
<?php

if(isset($_POST['update']))
{
$id =$_GET['id'];
$price=$_POST['price'];
$qty=$_POST['qty'];
$total =$price * $qty;
$status=$_POST['status'];
$customer_name=$_POST['customer_name'];
$customer_contact=$_POST['customer_contact'];
$customer_email=$_POST['customer_email'];
$customer_address=$_POST['customer_address'];


$query = " update tbl_order set 

qty=$qty,
total =$total,
status='$status',
customer_name='$customer_name',
customer_contact='$customer_contact',
customer_email='$customer_email',
customer_address='$customer_address' where id=$id ";

$res= mysqli_query($con,$query);

if($res)
    {
        $_SESSION['update'] = "<div style='color:seagreen'>Order Updated Successfully</div>";
        header("location:order.php");
    }

    else
    {
        echo' Please Check Your Query';
    }
}
?>


</div>


<?php
include('design/footer.php');
?>
