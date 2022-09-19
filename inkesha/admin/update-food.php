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
$query = "select * from food where id='".$id."'";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);

if($count==1)
{
$rows=mysqli_fetch_assoc($result);     
$title=$rows['title'];
$description=$rows['description'];
$price=$rows['price'];
$image_name=$rows['image_name'];
$category=$rows['category_id'];
$featured=$rows['featured'];
$active=$rows['active'];
}

?>

<div class="wrapper">
    <h1> Update Food Form</h1><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title </label><input type="text" name="title" value="<?php echo $title; ?>"><br><br>
        <label>Description </label><input type="text" name="description" value="<?php echo $description; ?>"><br><br>
        <label>Price </label><input type="text" name="price" value="<?php echo $price; ?>"><br><br>
        
         <tr>
            <td>Current image: </td>
            <td>
            <?php 
                if ($image_name != "") 
                {
                   ?>
                <img src="../img/food/<?php echo "$image_name"; ?>" width="120px">
                <?php    
                    }
                    else
                    {
                        echo "<div>image not added.</div>";
                    }

                ?>
            </td>
        </tr><br><br>
        <tr>
            <td>Select new image: </td>
            <td>
        <input type="file" name="image">
        </td>
        </tr><br><br>
        <tr>
            <label>Select Food Category: </label>
        <select name="category">
            <!-- php code for display categories from db -->
            <?php 
            $sql = "SELECT * FROM category WHERE active='yes' ";
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if($count>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    ?>

                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                <?php
                }
            }
            else
            {
                ?>
                <option value="0">No Category Found</option>
            <?php
            }
            ?>
        </select>
        </tr><br><br>
        <tr>
            <td>Featured: </td>
            <td>
        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
        <input <?php if($featured=="No"){echo "selected";} ?> type="radio" name="featured" value="No">No
        </td>
        </tr><br><br>
        <tr>
            <td>Active: </td>
            <td>
        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
        </td>
        </tr><br>
        <button class="btn-primary" value="update-food" type="submit" name="update">Update Food</button>
    </form>


    
<?php

require_once('design/connect.php');

if(isset($_POST['update']))
{
    // get all values from form
    $id =$_GET['id'];
    $title =$_POST['title'];
    $description =$_POST['description'];
    $price =$_POST['price'];
    $featured =$_POST['featured'];
    $active =$_POST['active'];

    // update image

    if (isset($_FILES['image']['name'])) 
    {
        // Get image details  
        $image_name = $_FILES['image']['name'];
        // check whether the image is available or not
        if ($image_name != "") 
        {
              // image available

            //1. upload the new image 
            // auto rename image get its extension jpg,png,jpeg to make it eg: food.jpg
            $ext = end(explode('.', $image_name));
            // rename then
            $image_name = "Food_Category_".rand(000, 999).".".$ext; // eg: Food_category_444.jpg

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../img/food/".$image_name;

            // final upload image

            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload==false) 
            {
                $_SESSION['upload'] = "<div>Failed</div>";
                header('location: food.php');
                die();
            }
            //2. remove the current one
            if($current_image!="")
            {
               $remove_path = "../img/food/".$current_image;

            $remove = unlink($remove_path);

            // check if the image is removed or not
            if ($remove==false) 
            {
                $_SESSION['failed-remove'] = "<div>failed</div>";
                header('location: food.php');
                die(); // stop the process
            } 
            }
        }
        else{
            $image_name = $current_image;
        } 
    }

    $query = " update food set title= '".$title."',description= '".$description."', price= '".$price."', image_name='".$image_name."', featured= '".$featured."', active= '".$active."' where id= '".$id."'";
    $result = mysqli_query($con,$query);

    if($result)
    {
        header("location:food.php");
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
