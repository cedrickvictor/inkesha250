<?php include('design/menu.php'); ?>
<?php include('design/connect.php'); ?>

<div class="wrapper">
	<h1> Category Form</h1><br>
<?php 
if (isset($_SESSION['add'])) 
{
	echo $_SESSION['add'];
	unset($_SESSION['add']);
}
?><br>
	<form action="" method="POST" enctype="multipart/form-data">
		<label>Title </label><input type="text" name="title" placeholder="Enter Category Name"><br><br>
		<tr>
			<td>Select image: </td>
			<td>
		<input type="file" name="image">
		</td>
		</tr><br><br>
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
		<button class="btn-primary" value="add-admin" type="submit" name="submit">Add Category</button>
	</form>
	
	<?php 

require_once('design/connect.php');

if(isset($_POST['submit']))
{
	// Button clicked
	// Get data from Form
		$title = $_POST['title'];
		
		// for radio input type we need to check whether it's selected

		if (isset($_POST['featured'])) 
		{
			// get the value from form
			$featured = $_POST['featured'];
		}
		else
		{
			$featured = "No";
		}
		if (isset($_POST['active'])) 
		{
			// get the value from form
			$active = $_POST['active'];
		}
		else
		{
			$active = "No";
		}

		// check whether image is selected set value of image
		// print_r($_FILES['image']);

		// die();
		// // insert query

		if (isset($_FILES['image']['name'])) 
    {
			// upload image
			// name, source path and destination
			$image_name = $_FILES['image']['name'];

			// upload the image only if image is selected
		    if ($image_name !="")
		{
		     	
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
				header('location: add-category.php');
				die();
			}

		}
		else
		{
			// not upload
			$image_name="";
		}

		$query = "insert into category (title,image_name,featured,active) values ('$title','$image_name','$featured','$active')";

		// execute the query and save into db

		$result = mysqli_query($con,$query);

		// check whether the query is executed

		if ($result==true) {
			//category added
			$_SESSION['add'] = "<div style='color:seagreen'>category added successfully</div>";
			// redirect
			header('location: category.php');
		}
		else
		{
			//failed
			$_SESSION['add'] = "<div style='color:red'>Fail to add category</div>";
			// redirect
			header('location: add-category.php');

		}
	}
}

	?>


</div>
<?php include('design/footer.php'); ?>