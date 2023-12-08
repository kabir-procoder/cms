
   
<?php 


if(isset($_POST['create_user'])){
	
	$user_firstname = $_POST['user_firstname'];
	$user_lastname  = $_POST['user_lastname'];
	$user_role      = $_POST['user_role'];
	$username       = $_POST['username'];
	$user_email     = $_POST['user_email'];
	$user_password  = $_POST['user_password'];

	 $user_password = password_hash($user_password,PASSWORD_BCRYPT, array('cost' => 10));
	
	$query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";
	$query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";
	$create_users_query = mysqli_query($connection,$query);
	confirmQuery($create_users_query);
	
	echo "<p class='bg-success'>User Creatted Successful. <a href='users.php'>View Users</a></p>";
	
	
}





?>
   
   
   
   
   
   
   
   
    <form action="" method="post" enctype="multipart/form-data">    
     
       
       <div class="form-group">
         <label for="title">Firstname</label>
          <input type="firstname" class="form-control" name="user_firstname">
      </div>  
        
        
        <div class="form-group">
       <label for="category">Lastname</label>
       <input type="lastname" class="form-control" name="user_lastname">
      </div>


       <div class="form-group">
         <select name="user_role" id="">
             <option value="subscriber">User Role</option>
             <option value="admin">Admin</option>
             <option value="subscriber">Subscriber</option>
         </select>
      </div>
      

      
       <div class="form-group">
         <label for="title">Username</label>
          <input type="username" class="form-control" name="username">   
      </div>
      
       <div class="form-group">
         <label for="title">Email</label>
          <input type="email" class="form-control" name="user_email">
          
      </div>
      

      <div class="form-group">
         <label for="password">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Publish Post">
      </div>


</form>