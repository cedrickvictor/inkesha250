<?php include('partials/menu.php');?>

<?php include('partials/connect.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



<?php

//sql for display category 
$sql2 = "select * from food where active = 'yes'";
// execute the query
$result2 = mysqli_query($con,$sql2);

$count2 = mysqli_num_rows($result2);

if($count2>0)
{
    // category available
    while($row=mysqli_fetch_assoc($result2))
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
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$ <?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
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
            echo "<div class='error'> image not found</div>";
        }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php

include('partials/footer.php');

?>