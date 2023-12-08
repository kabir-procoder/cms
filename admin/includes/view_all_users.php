					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th>Username</th>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
								<th>Role</th>
								<th>Admin</th>
								<th>Subscriber</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>		
						<tbody>
						
		<?php


		$query = "SELECT * FROM users";
		$users_query = mysqli_query($connection,$query);	
		while($row = mysqli_fetch_assoc($users_query)){
		$user_id        = $row['user_id'];	
		$username       = $row['username'];	
		$user_firstname = $row['user_firstname'];	
		$user_lastname  = $row['user_lastname'];	
		$user_email     = $row['user_email'];	
		$user_role      = $row['user_role'];	



		echo "<tr>";	
		echo "<td>{$user_id}</td>";	
		echo "<td>{$username}</td>";	
		echo "<td>{$user_firstname}</td>";
		echo "<td>{$user_lastname}</td>";	
		echo "<td>{$user_email}</td>";	
		echo "<td>{$user_role}</td>";		
		echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";	
		echo "<td><a href='users.php?subscriber={$user_id}'>Subscriber</a></td>";	
		echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";	
		echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";		
		echo "</tr>";	


		}	



		?>


		</tbody>
	</table>



	<?php

	if(isset($_GET['admin'])){

	  $admin_id = $_GET['admin'];
	  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$admin_id} ";
	  $subscriber_query = mysqli_query($connection,$query);
	  header("Location: users.php");

	}

	if(isset($_GET['subscriber'])){

	  $subscriber_id = $_GET['subscriber'];
	  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$subscriber_id} ";
	  $subscriber_query = mysqli_query($connection,$query);
	  header("Location: users.php");

	}

	if(isset($_GET['delete'])){
        
      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){   

	  $user_delete_id = mysqli_real_escape_string($connection,$_GET['delete']);
	  $query = "DELETE FROM users WHERE user_id = {$user_delete_id} ";
	  $users_delete_query = mysqli_query($connection,$query);
	  header("Location: users.php");

	}

}




	?>

