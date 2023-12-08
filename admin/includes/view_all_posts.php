<?php  include "delete_modal.php";


if(isset($_POST['checkBoxArray'])){
    

  foreach($_POST['checkBoxArray'] as $postValueId) {
    
      $bulk_options = $_POST['bulk_options'];
      
      switch($bulk_options){
              
          case "published":
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";    
          $publish_posts = mysqli_query($connection,$query);    
          break; 
              
          case "draft":
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";    
          $draft_posts = mysqli_query($connection,$query);    
          break;
              
          case "delete":
          $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";    
          $delete_posts = mysqli_query($connection,$query);    
          break; 
              
         case "clone":
          $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";    
          $clone_posts = mysqli_query($connection,$query); 
          while($row = mysqli_fetch_array($clone_posts)) {
                $post_category_id   = $row['post_category_id'];
                $post_author        = $row['post_author'];
                $post_title         = $row['post_title'];
                $post_date          = $row['post_date'];
                $post_image         = $row['post_image'];
                $post_content       = $row['post_content'];
                $post_tags          = $row['post_tags'];
                  
              
              
          }  
              
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags) ";
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}') "; 
        $clone_add_posts = mysqli_query($connection,$query);          
        confirmQuery($clone_add_posts);          
              
              
         break;           
      }
      
   }    
    
}
?>							
    <form action="" method="post">													

        <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4" style="padding-left: 0px;">
          <select name="bulk_options" id="" class="form-control">
           <option value="">Select Options</option>   
           <option value="published">Published</option>   
           <option value="draft">Draft</option>   
           <option value="delete">Delete</option>         
           <option value="clone">Clone</option>         
        </select>    
        </div> 
        <div class="col-xs-3" style="padding-left: 0px;">
        <input type="submit" name="submit" class="btn" style="background:#4169E1;color:white;" value="Apply">
        <a href="./posts.php?source=add_post" class="btn btn-info">Add New</a>
        </div>

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Users</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>		
            <tbody>

            <?php

            $query = "SELECT * FROM posts";	
            $select_all_posts = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_all_posts)){

                $post_id            = $row['post_id'];
                $post_category_id   = $row['post_category_id'];
                $post_author        = $row['post_author'];
                $post_user          = $row['post_user'];
                $post_title         = $row['post_title'];
                $post_date          = $row['post_date'];
                $post_image         = $row['post_image'];
                $post_content       = $row['post_content'];
                $post_tags          = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status        = $row['post_status'];
                $post_views_count   = $row['post_views_count'];



                echo "<tr>";

                ?>

                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>

               <?php 
                echo "<td>{$post_id}</td>";
                
                if(!empty($post_author)){
                
                echo "<td>{$post_author}</td>";    
                    
                }else if(!empty($post_user)){
                    
                  echo "<td>{$post_user}</td>";  
                }
                                
                echo "<td>{$post_title}</td>";
                
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                $select_all_categories = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_all_categories)){
                    
                $cat_id = $row['cat_id'];    
                $cat_title = $row['cat_title'];    
                echo "<td>{$cat_title}</td>";   
                    
                }               
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $select_comment_count = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_comment_count)){
                $comment_id = $row['comment_id'];    
                }
                $comment_count = mysqli_num_rows($select_comment_count);
                echo "<td><a href='post_comments.php?id={$post_id}'>{$comment_count}</a></td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a class='btn btn-info' href='../post.php?p_id=$post_id'>View Post</a></td>";
                echo "<td><a class='btn btn-info' href='./posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a rel='$post_id' class='btn text-muted delete_link' style='background-color: #FF0000;color: #FFFFFF;' href='javascript:void(0)'>Delete</a></td>";         
//                echo "<td><a class='btn text-muted' style='background-color: #FF0000;color: #FFFFFF;' href='./posts.php?delete={$post_id}'>Delete</a></td>";                            
                echo "<td><a href='./posts.php?reset={$post_id}'>$post_views_count</a></td>";
                echo "</tr>";	

            }	

            ?>
            </tbody>
        </table>

    </form>	
<?php 

if(isset($_GET['delete'])){
	
	$delete_post_id = $_GET['delete'];
	$query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
	$delete_post_query = mysqli_query($connection,$query);
	header("Location: ./posts.php");	
}

if(isset($_GET['reset'])){
	
	$reset_post_id = $_GET['reset'];
	$query = "UPDATE posts SET post_views_count = 0 WHERE post_id =".mysqli_real_escape_string($connection,$_GET['reset'])." ";
	$reset_query = mysqli_query($connection,$query);
	header("Location: ./posts.php");	
	
}



?>

<script>
    $(document).ready(function(){
    
    $(".delete_link").on('click', function(){
        
     var id = $(this).attr("rel"); 
        
     var delete_url = "./posts.php?delete="+id+" ";  
        
     $(".modal_delete_link").attr("href", delete_url);   
        
      $("#myModal").modal('show');  
        
    });
        
        
//     var div_box = "./posts.php?delete={$post_id}";   
        
        
    });





</script>










