

		<?php 

		if(isset($_GET['edit_user'])){

			$edit_user = $_GET['edit_user'];

			$query = "SELECT * FROM users WHERE user_id = {$edit_user} ";
			$update_user_query = mysqli_query($connection,$query);

			while($row = mysqli_fetch_assoc($update_user_query)){
				$user_id        = $row['user_id'];	
				$username       = $row['username'];	
				$user_firstname = $row['user_firstname'];	
				$user_lastname  = $row['user_lastname'];	
				$user_email     = $row['user_email'];	
				$user_role      = $row['user_role'];
				$user_password  = $row['user_password'];



			}

		


		if(isset($_POST['edit_user'])){

			$user_firstname = $_POST['user_firstname'];
			$user_lastname  = $_POST['user_lastname'];
			$user_role      = $_POST['user_role'];
			$username       = $_POST['username'];
			$user_email     = $_POST['user_email'];
			$user_password  = $_POST['user_password'];
            
            if(empty($user_password)){
                
             echo "<script>alert('Your password fields is empty! has been old password')</script>";   
                
            }else{
            
            
            if(!empty($user_password)){

                $query = "SELECT user_password FROM users WHERE user_id = {$edit_user} "; 
                $password_user_query = mysqli_query($connection,$query);
                confirmQuery($password_user_query);
                while($row = mysqli_fetch_array($password_user_query)){

                $db_user_password = $row['user_password'];                       

              }


            if($db_user_password != $user_password){

                $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));  

            } 

            $query = "UPDATE users SET ";
			$query .= "user_firstname = '{$user_firstname}', ";
			$query .= "user_lastname = '{$user_lastname}', ";
			$query .= "username = '{$username}', ";
			$query .= "user_email = '{$user_email}', ";
			$query .= "user_password = '{$user_password}', ";
			$query .= "user_role = '{$user_role}' ";
			$query .= "WHERE user_id = {$edit_user} ";


			$update_user_query = mysqli_query($connection,$query);



			echo "<p class='bg-success'>User Updated Successful. <a href='users.php'>View User?</a></p>";  
                      
                
            }
         }   
      }
   }else{
			
			header("Location: index.php");
			
		}



		?>
   
   
   
     <form action="" method="post" enctype="multipart/form-data">    
     
       
       <div class="form-group">
         <label for="title">Firstname</label>
          <input value="<?php echo $user_firstname; ?>" type="firstname" class="form-control" name="user_firstname">
      </div>  
        
        
      <div class="form-group">
       <label for="category">Lastname</label>
       <input value="<?php echo $user_lastname; ?>" type="lastname" class="form-control" name="user_lastname">
      </div>

       <div class="form-group">
         <select name="user_role" id="">
         <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
         <?php 
             
           if($user_role == 'admin') {
               
             echo "<option value='subscriber'>subscriber</option>";  
               
           }else{
               
               echo "<option value='admin'>admin</option>";
               
           } 
             
             
         ?>
         
         
         

         </select>
      </div>
            
      <div class="form-group">
         <label for="title">Username</label>
          <input type="username" value="<?php echo $username; ?>" class="form-control" name="username">   
      </div>
      
      <div class="form-group">
         <label for="title">Email</label>
          <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email"> 
      </div>

     <div class="form-group">
         <label for="password">Password</label>
          <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
     </div>     

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Publish Post">
      </div>


</form>