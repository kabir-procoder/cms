			<form action="" method="post">

			<div class="form-group">
			
			<label for="">Update Category</label>
			
			<?php

			if(isset($_GET['edit'])) {

			$cat_id = $_GET['edit'];	

			$query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
			$update_categories = mysqli_query($connection,$query);
			while($row = mysqli_fetch_assoc($update_categories)){
			$cat_id = $row['cat_id'];	
			$cat_title = $row['cat_title']; 

			?>

			<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title" class="form-control">

			<?php } }?>

			<?php 

			if(isset($_POST['update_category'])){	

			$the_cat_title = $_POST['cat_title'];			
			$query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = $cat_id ";
			$update_categories = mysqli_query($connection,$query);


			}


			?>


        
			</div>
			<div class="form-group-btn">
			<input type="submit" name="update_category" class="btn btn-primary" value="Update Category">
			</div>
			</form>
