<?php include('partials/menu.php'); ?>

<?php include('partials/connect.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php

        //sql for display category 
        $sql = "select * from category where active = 'yes' and featured = 'yes' limit 3";
        // execute the query
        $result = mysqli_query($con, $sql);

        $count = mysqli_num_rows($result);

        if ($count > 0) {
            // category available
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="category-foods.php?category_id=<?php echo $id; ?> ">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            // display name
                            echo "<div class='error'> Image not Available<div>";
                        } 
                        else 
                        {  // image available
                        ?>
                            <img src="img/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                </a>




        <?php
            }
        } else {
            // category not available
            echo "<div class='error'> categorynot found </div>";
        }

        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php

        //sql for display category 
        $sql2 = "select * from food where active = 'yes' and featured = 'yes' limit 6";
        // execute the query
        $result2 = mysqli_query($con, $sql2);

        $count2 = mysqli_num_rows($result2);

        if ($count2 > 0) {
            // category available
            while ($row = mysqli_fetch_assoc($result2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            // display name
                            echo "<div class='error'> Image not Available<div>";
                        } else {  // image available
                        ?>
                            <img src="img/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
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
        } else {
            echo "<div class='error'> image not found</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->



<!-- contact section stars -->


<section id="contact">
<div class="container">
        <form class="message">
            <h3>GET IN TOUCH WITH US</h3>
            <input type="text" id="name"
            placeholder="Enter Your Name" required>
            <input type="email" id="email"
            placeholder="Enter Your Email Id" required>
            <input type="phone" id="phone"
            placeholder="Enter Your Phone Number">
            <textarea placeholder="Enter Your Comments" cols="20" rows="10"></textarea>
            
            <button type="submit">Send</button>

        </form>

    </div>


<div class="map">
    

            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31900.58928993944!2d30.025678789930755!3d-1.9220143686262947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca47595e2c3ef%3A0x6f5bbce4f1ca824c!2sGatsata%2C%20Kigali!5e0!3m2!1sen!2srw!4v1643974130895!5m2!1sen!2srw" width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


</div>

</section>

<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-9b554a20-c199-4f7d-afa0-7e9388e0f704"></div>



<?php

include('partials/footer.php');

?>