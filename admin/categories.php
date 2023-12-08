<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


<?php include "includes/admin_navigation.php"; ?>
       
       
       
       
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to categories
                            
                            
                        </h1>
                      
                        
                        <div class="col-sm-6">
						<!--insert categories-->
						<!--insert categories-->
                        <?php insert_categories(); ?>
						
                        <form action="" method="post">
                        	<div class="form-group">
                       	  <label for="">Add Category</label>
                        	  <input type="text" name="cat_title" class="form-control">
                        	</div>
                        	<div class="form-group-btn">
                        	<input type="submit" name="submit" class="btn btn-primary mb-2" value="Add Category">
                        	</div>
                        	</form>
                        	
                        	<?php //UPDATE AND INCLUDE  QUERY
							
							if(isset($_GET['edit'])){
								
							$cat_id = $_GET['edit'];	
								
							include "includes/update_categories.php";	
								
							}
							
							
							?>
                        	 
						
							
                        </div>
                        
						<div class="col-sm-6">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Categories</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									
                                    <!--FIND ALL CATEGORIES	-->
                                    <!--FIND ALL CATEGORIES	-->
									<?php findAllCategories(); ?>	
									<!--DELETE CATEGORIES-->
									<!--DELETE CATEGORIES-->								    
                                    <?php deleteCategories(); ?>

									
								</tbody>
							</table>
						</div>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

      <?php include "includes/admin_footer.php"; ?>