<?php include('partials/menu.php');?>

<?php include('partials/connect.php');?>


<?php
// check if ID is passed
if(isset($_GET['category_id']))
{
    $category_id =  $_GET['category_id'];
    $sql = "select title from category where id=$category_id";
    $result = mysqli_query($con,$sql);

    // get the value from db

    $row = mysqli_fetch_assoc($result);

    // get the title name of category

    $category_title = $row['title']; 

}
else
{
    header('location: index.php');
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

            // create sql based on selected category
            $sql2 = "select * from food where category_id=$category_id";

            $result2 = mysqli_query($con,$sql2);

            // count the rows in db

            $count2 = mysqli_num_rows($result2);

            if($count2>0)
            {
                // food is available
                while($row2=mysqli_fetch_assoc($result2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                    <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                if($image_name=="")
                {
                    // display name
                    echo "<div class='error'> Image not Available <div>";
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
                    <h4><?php echo $title ?></h4>
                    <p class="food-price"><?php echo $price ?></p>
                    <p class="food-detail">
                       <?php echo $description ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


                    <?php

                }
            }
            else
            {
                // food is not available
                echo "<div class='error'> Food is not Available <div>";
            }

            ?>

           
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php

include('partials/footer.php');

?>