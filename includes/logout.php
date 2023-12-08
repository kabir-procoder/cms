<?php session_start(); ?>

       
	
<?php 
		
		$_SESSION['username'] = NULL;
		$_SESSION['firstname'] = NULL;
		$_SESSION['lastname'] = NULL;
		$_SESSION['user_role'] = NULL;
      

      header("Location: ../index.php");



?>