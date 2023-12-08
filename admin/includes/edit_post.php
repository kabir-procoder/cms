<?php 
        if(isset($_GET['p_id'])){

            $edit_post = $_GET['p_id'];

            $query = "SELECT * FROM posts WHERE post_id = {$edit_post} ";
            $update_posts_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($update_posts_query)){
            $post_id            = $row['post_id'];
            $post_category_id   = $row['post_category_id'];
            $post_author        = $row['post_author'];
            $post_user          = $row['post_user'];
            $post_user          = $row['post_user'];
            $post_title         = $row['post_title'];
            $post_date          = $row['post_date'];
            $post_image         = $row['post_image'];
            $post_content       = $row['post_content'];
            $post_tags          = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status        = $row['post_status'];	
            }
        }
        if(isset($_POST['create_post'])){

            $post_title = $_POST['post_title'];
            $post_user = $_POST['post_user'];
            $post_category_id = $_POST['post_category_id'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = escape($_POST['post_content']);
            $post_comment_count = 1;

            if(empty($post_image)){

                $query = "SELECT * FROM posts WHERE post_id = {$edit_post} ";
                $post_image_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($post_image_query)){

                $post_image = $row['post_image'];

                }
            }
            $query = "UPDATE posts SET ";
            $query .= "post_category_id = {$post_category_id}, ";
            $query .= "post_user = '{$post_user}', ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_date = now(), ";
            $query .= "post_image = '{$post_image}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}' ";
            $query .= "WHERE post_id = {$edit_post} ";

            $update_query = mysqli_query($connection,$query);

            echo "<p class='bg-success'>Post Update Successful. <a href='./posts.php'>Update More Post</a> or <a href='../post.php?p_id={$edit_post}'>View Post?</a></p>";

        }
?>
    <form action="" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="title">Post Title</label>
          <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
      </div>
       <div class="form-group">
         <label for="title">Select Users</label>
         <select name="post_user" id="">
         
          <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
          
           <?php
             
             $query = "SELECT * FROM users";
             $edit_users_query = mysqli_query($connection,$query);
             confirmQuery($edit_users_query);
             while($row = mysqli_fetch_array($edit_users_query)){
               $user_id  = $row['user_id']; 
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
          confirmQuery($select_all_categories);   
          while($row = mysqli_fetch_assoc($select_all_categories)) {
           $cat_id    = $row['cat_id'];   
           $cat_title = $row['cat_title'];
           
           if($cat_id == $post_category_id){   
           echo "<option selected value='{$cat_id}'>{$cat_title}</option>";   
         }else{
           echo "<option value='{$cat_id}'>{$cat_title}</option>";   
          }
          } 
          ?>   
        </select>
        </div> 
       <div class="form-group">
         <select name="post_status" id="">
          <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
         <?php 
           if($post_status == 'published'){
             echo "<option value='draft'>draft</option>"; 
           } else{
               echo "<option value='published'>published</option>"; 
           } 
         ?>
         </select>
      </div>
    <div class="form-group">
         <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
          <input type="file" name="image">
      </div>
      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
      </div>
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>