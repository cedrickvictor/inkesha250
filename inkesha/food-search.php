<?php include('partials/menu.php');?>

<?php include('partials/connect.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            // Get a search keyword 
            // $search =$_POST['search']
            // avoid errors and hackers by protect it with real escape 
            $search = mysqli_real_escape_string($con,$_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php


            // query to get food based on search food

            $sql = "select * from food where title like '%$search%' or description like '%$search%'";
            // execute query

            $result = mysqli_query($con,$sql);

            $count = mysqli_num_rows($result);

            if($count>0)
            {
                // food available
                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                <div class="food-menu-box">
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
                    <h4><?php echo $title ;?></h4>
                    <p class="food-price"><?php echo $price ;?></p>
                    <p class="food-detail">
                        <?php echo $description ;?>
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
                //food not available
            }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php

include('partials/footer.php');

?>