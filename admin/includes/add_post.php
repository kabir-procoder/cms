<?php 
if(isset($_POST['create_post'])){
	
	$post_title = $_POST['post_title'];
	$post_user = $_POST['post_user'];
	$post_category_id = $_POST['post_category_id'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];
	$post_tags = $_POST['post_tags'];
	$post_content = escape($_POST['post_content']);
    
    move_uploaded_file($post_image_temp, "../images/$post_image");

	$query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";
	$query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
	$create_posts_query = mysqli_query($connection,$query);
	confirmQuery($create_posts_query);
	
	echo "<p class='bg-success'>Post Creatted Successful. <a href='posts.php'>View Post</a></p>";
}
?> 
    <form action="" method="post" enctype="multipart/form-data">         
         
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">   
      </div>
       <div class="form-group">
         <label for="title">Select Users</label>
         <select name="post_user" id="">
         
         <?php
           
          $query = "SELECT * FROM users";
          $select_all_users = mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($select_all_users)){
           
           $username = $row['username'];
              
           echo "<option value='{$username}'>{$username}</option>";    
              
           } 
 
        ?>
        </select> 
         
      </div> 
        <div class="form-group">
        <label for="">Category</label>
        <select name="post_category_id" id="">
         <?php 
          
          $query = "SELECT * FROM categories ";
          $select_all_categories = mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($select_all_categories)) {
           $cat_id    = $row['cat_id'];   
           $cat_title = $row['cat_title'];   
           echo "<option value='{$cat_id}'>{$cat_title}</option>";   
              
          } 
   
          ?>   
  
        </select>
        </div>

       <div class="form-group">
         <select name="post_status" id="">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file" name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="textarea" cols="30" rows="10"></textarea>
      </div>
      
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>