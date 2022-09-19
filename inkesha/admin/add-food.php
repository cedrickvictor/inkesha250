<?php
include('design/menu.php');
?>
<?php 	

session_start();

include("design/connect.php");
include("functions.php");

$user_data = check_login($con);

?>
<div class="wrapper">
	<h1> Add Food Type </h1><br>
<?php
if(isset($_SESSION['upload'])){
	echo $_SESSION['upload'];
	unset ($_SESSION['upload']);
}
?>
	<form action="" method="POST" enctype="multipart/form-data">
		<label>Title: </label><input type="text" name="title" placeholder="Enter Category Name"><br><br>
		<label>Description: </label><br>
			<textarea rows="4" name="description"></textarea><br><br>
		<label>Price: </label><input type="text" name="price"><br>
		<tr>
			<td>Select image: </td>
			<td>
		<input type="file" name="image">
		</td>
		</tr><br><br>
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
		</select><br><br>
		<tr>
			<td>Featured: </td>
			<td>
		<input type="radio" name="featured" value="Yes">Yes
		<input type="radio" name="featured" value="No">No
		</td>
		</tr><br><br>
		<tr>
			<td>Active: </td>
			<td>
		<input type="radio" name="active" value="Yes">Yes
		<input type="radio" name="active" value="No">No
		</td>
		</tr><br>
		<button class="btn-primary" value="add-admin" type="submit" name="submit">Add Food</button>
	</form>

<?php 

if(isset($_POST['submit']))
{
	//1. get data from form
	$title = $_POST['title'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category = $_POST['category'];

	if(isset($_POST['featured']))
	{
		$featured = $_POST['featured'];
	}
	else
	{
		$featured = "No";
	}
	if (isset($_POST['active'])) 
	{
		$active = $_POST['active'];	
	}
	else
	{
		$active = "No";
	}
	//2. upload image
	if(isset($_FILES['image']['name']))
	{
		$image_name = $_FILES['image']['name'];	
		if($image_name!= "")
		{
			// Get the extension(jpg, png,gif,etc.)
			$ext = end(explode('.', $image_name));
			// create the new name for image
			$image_name = "Food-Name-".rand(0000,9999).".".$ext;
			//upload the image and get it's src path and destination
			$src = $_FILES['image']['tmp_name'];
			$dst = "../img/food/".$image_name;
			$upload = move_uploaded_file($src,$dst);
			// check whether is not uploaded
			if($upload==false)
			{
				//fail to upload redirect the page
			$_SESSION['upload'] = "<div>Failed</div>";
				header('location: add-food.php');
				// stop the process
				die();
			}
		}
	}
	else
	{
		$image_name = "";
	}
	//3. insert into db

	// create a query to save image
	$query = "insert into food (title,description,price,image_name,category_id,featured,active) values ('$title','$description','$price','$image_name','$category','$featured','$active')";
	$res = mysqli_query($con,$query);

	// check whether the query is executed

		if ($res==true) {
			//food added
			$_SESSION['add'] = "<div style='color:seagreen'>food added successfully</div>";
			// redirect
			header('location: food.php');
		}
		else
		{
			//failed
			$_SESSION['add'] = "<div style='color:red'>Fail to add category</div>";
			// redirect
			header('location: add-category.php');

		}
	//4. redirect message
}

?>


</div>
 
<?php
include('design/footer.php');
?>