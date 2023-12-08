<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


<?php include "includes/admin_navigation.php"; ?>
       
       
       
       
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Comments
                            <small>Subheading</small>
                          </h1>
    
    
    <table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Author</th>
				<th>Comment</th>
				<th>Email</th>
				<th>Status</th>
				<th>Date</th>
				<th>Comment Post Id</th>
				<th>Approve</th>
				<th>Unapprove</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		

		


		<?php
            
   


		$query = "SELECT * FROM comments WHERE comment_post_id =". mysqli_real_escape_string($connection, $_GET['id'])." ";
		$comments_query = mysqli_query($connection,$query);	
		while($row = mysqli_fetch_assoc($comments_query)){
		$comment_id = $row['comment_id'];	
		$comment_post_id = $row['comment_post_id'];	
		$comment_author = $row['comment_author'];	
		$comment_email = $row['comment_email'];	
		$comment_content = $row['comment_content'];	
		$comment_status = $row['comment_status'];	
		$comment_date = $row['comment_date'];


		echo "<tr>";	
		echo "<td>{$comment_id}</td>";	
		echo "<td>{$comment_author}</td>";	
		echo "<td>{$comment_content}</td>";
		echo "<td>{$comment_email}</td>";	
		echo "<td>{$comment_status}</td>";	
		echo "<td>{$comment_date}</td>";

		$query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";	
		$comment_post_id_query = mysqli_query($connection,$query);
		while($row = mysqli_fetch_array($comment_post_id_query)){

		$post_id = $row['post_id'];
		$post_title = $row['post_title'];

		echo "<td><a href='./post.php?p_id={$post_id}'>{$post_title}</a></td>";	

		}		
		echo "<td><a href='post_comments.php?approved={$comment_id}&id=".$_GET['id']."'>Approved</a></td>";	
		echo "<td><a href='post_comments.php?unapproved={$comment_id}&id=".$_GET['id']."'>Unapproved</a></td>";	
		echo "<td><a href='post_comments.php?delete={$comment_id}&id=".$_GET['id']."'>Delete</a></td>";		
		echo "</tr>";	


		}	



		?>


		</tbody>
	</table>



	<?php

	if(isset($_GET['approved'])){

	  $comment__id_approved = $_GET['approved'];
	  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment__id_approved} ";
	  $comment_approved_query = mysqli_query($connection,$query);
	  header("Location: post_comments.php?id=".$_GET['id']."");

	}

	if(isset($_GET['unapproved'])){

	  $comment__id_unapproved = $_GET['unapproved'];
	  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment__id_unapproved} ";
	  $comment_unapproved_query = mysqli_query($connection,$query);
	 header("Location: post_comments.php?id=".$_GET['id']."");

	}

	if(isset($_GET['delete'])){

	  $comment_delete_id = $_GET['delete'];
	  $query = "DELETE FROM comments WHERE comment_id = {$comment_delete_id} ";
	  $comment_delete_query = mysqli_query($connection,$query);
	  header("Location: post_comments.php?id=".$_GET['id']."");

	}






	?>



 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

      <?php include "includes/admin_footer.php"; ?>
