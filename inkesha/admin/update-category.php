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
$query = "select * from category where id='".$id."'";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);

if($count==1)
{
$row=mysqli_fetch_assoc($result);     
$title = $row['title'];
$current_image = $row['image_name'];
$featured = $row['featured'];
$active = $row['active'];
}

?>

<div class="wrapper">
    <h1> Update Category Form</h1><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title </label><input type="text" name="title" value="<?php echo $title; ?>"><br><br>
         <tr>
            <td>Current image: </td>
            <td>
            <?php 
                if ($current_image != "") 
                {
                   ?>
                <img src="../img/category/<?php echo "$current_image"; ?>" width="120px">
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
        <button class="btn-primary" value="update-category" type="submit" name="update">Update Category</button>
    </form>


    
<?php

require_once('design/connect.php');

if(isset($_POST['update']))
{
    // get all values from form
    $id =$_GET['id'];
    $title =$_POST['title'];
    
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
            $destination_path = "../img/category/".$image_name;

            // final upload image

            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload==false) 
            {
                $_SESSION['upload'] = "<div>Failed</div>";
                header('location: category.php');
                die();
            }
            //2. remove the current one
            if($current_image!="")
            {
               $remove_path = "../img/category/".$current_image;

            $remove = unlink($remove_path);

            // check if the image is removed or not
            if ($remove==false) 
            {
                $_SESSION['failed-remove'] = "<div>failed</div>";
                header('location: category.php');
                die(); // stop the process
            } 
            }
        }
        else
        {
            $image_name = $current_image;
        }  
    }

    $query = " update category set title= '".$title."', image_name='".$image_name."', featured= '".$featured."', active= '".$active."' where id= '".$id."'";
    $result = mysqli_query($con,$query);

    if($result)
    {
        $_SESSION['update'] = "<div style='color:seagreen'>Category Updated Successfully</div>";
        header("location:category.php");
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
