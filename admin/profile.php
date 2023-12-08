<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


<?php include "includes/admin_navigation.php"; ?>
       
       
       
       
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to my profile
                            <small><?php echo  $_SESSION['username']; ?></small>
                          </h1>
                       
		
   
<?php 
                        
                        
            if(isset($_SESSION['username'])){
                
            $username = $_SESSION['username'];
            $query = "SELECT * FROM users WHERE username = '{$username}' ";
            $user_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($user_query)){		
                $user_id        = $row['user_id'];	
                $username       = $row['username'];	
                $user_firstname = $row['user_firstname'];	
                $user_lastname  = $row['user_lastname'];	
                $user_email     = $row['user_email'];	
                $user_role      = $row['user_role'];
                $user_password  = $row['user_password'];    

            }

         }                   


            if(isset($_POST['user_profile'])){

                $user_firstname = $_POST['user_firstname'];
                $user_lastname  = $_POST['user_lastname'];
                $user_role      = $_POST['user_role'];
                $username       = $_POST['username'];
                $user_email     = $_POST['user_email'];
                $user_password  = $_POST['user_password'];

                $query = "UPDATE users SET ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_role = '{$user_role}', ";
                $query .= "username = '{$username}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_password = '{$user_password}' ";
                $query .= "WHERE username = '{$username}' ";




            $profile_users_query = mysqli_query($connection,$query);
            comfirmQuery($profile_users_query);


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
          <input class="btn btn-primary" type="submit" name="user_profile" value="Update Profile">
      </div>


</form>
                            

                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

      <?php include "includes/admin_footer.php"; ?>