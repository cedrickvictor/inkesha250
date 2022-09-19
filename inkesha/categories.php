<?php include('partials/menu.php');?>

<?php include('partials/connect.php');?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            // display all categories that are active 

            $sql = "select * from category where active = 'yes'";

            // execute the query
$result = mysqli_query($con,$sql);

$count = mysqli_num_rows($result);

if($count>0)
{
    // category available
    while($row=mysqli_fetch_assoc($result))
    {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        ?>
         <a href="category-foods.php?category_id=<?php echo $id; ?> ">
            <div class="box-3 float-container">
                <?php
                if($image_name=="")
                {
                    // display name
                    echo "<div class='error'> Image not Available <div>";
                }
                else
                {  // image available
                    ?>
                <img src="img/category/<?php echo $image_name;?>" class="img-responsive img-curve">
                    <?php
                }
                ?>
                
                <h3 class="float-text text-white"><?php echo $title ?></h3>
            </div>
            </a>




        <?php
    }
}
else
{
    // category not available
    echo "<div class='error'> category not found </div>";
}

?>  
            
<div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php

include('partials/footer.php');

?>