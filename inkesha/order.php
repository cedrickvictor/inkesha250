<?php include('partials/menu.php');?>

<?php include('partials/connect.php');?>

<?php

if(isset($_GET['food_id']))
{
    // get the food id 
    $food_id = $_GET['food_id'];
    // get the food details then
    $sql = "select * from food where id=$food_id";
    $result= mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);

    if($count==1)
    {
        $row = mysqli_fetch_assoc($result);
        $title = $row ['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
    // redirect to the homepage
    header('location:index.php');
    }
}

else
{
    // redirect to the homepage
    header('location:index.php');
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                       <?php
                if($image_name=="")
                {
                    // display name
                    echo "<div class='error'> Image not Available<div>";
                }
                else
                {  // image available
                    ?>
                <img src="img/food/<?php echo $image_name;?>" class="img-responsive img-curve">
                    <?php
                }
                ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" title="Enter the quantity you need" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ngango bobic" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 078xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. inkesha@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" title="Enter your location" required></textarea>

                    <input id="order" type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

            if(isset($_POST['submit']))
            {
                // get the data from form
                
                $food =$_POST['food'];
                $price =$_POST['price'];
                $qty =$_POST['qty'];
                $total = $price * $qty;

                $order_date = date("y-m-d h:i:sa"); // ordering date 
                $status = "ordered"; // ordered, delevired and cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];


                // save the order in db

                $sql2 = "insert into tbl_order set
                food ='$food',
                price ='$price',
                qty ='$qty',
                total='$total',
                order_date ='$order_date',
                status ='$status',
                customer_name ='$customer_name',
                customer_contact ='$customer_contact',
                customer_email ='$customer_email',
                customer_address ='$customer_address'";

                $result2 = mysqli_query($con,$sql2);

                if($result2==true)
                {
                    // order saved
                    $_SESSION['oder'] = "<div class='sucess'> food ordered successfuly <div>";
                    header('location: index.php');
                }
                else
                {
                    // order not saved
                    $_SESSION['oder'] = "<div class='sucess'> food ordered failed <div>";
                    header('location: index.php');
                }
            }


            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<script>
    

</script>

   <?php

include('partials/footer.php');

?>