            <div class="col-md-4">
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>
                </div>
                
                                <!-- login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                     <input type="username" name="username" class="form-control" placeholder="Enter Your Username">	                    	
                    </div>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="Enterv Your Password">	
						<span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="login">
                                Submit
                        </button>
                        </span>
                    	
                    </div>
                    <!-- /.input-group -->
                    </form>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            
                            <?php
								
							$query = "SELECT * FROM categories LIMIT 4 ";	
							$select_all_categories = mysqli_query($connection,$query);
							while($row = mysqli_fetch_array($select_all_categories)){
							$cat_id    = $row['cat_id'];
							$cat_title = $row['cat_title'];
							echo "<li><a href='category.php?category={$cat_id}'>$cat_title</a></li>";

							}	
							?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                 
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
<!--                <div class="col-lg-12">-->
<!--                <section id="login">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-xs-6">-->
<!--                <div class="form-wrap">-->
<!--                <h1 class="text-center">Register</h1>-->
<!--                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">-->
<!--                        <div class="form-group">-->
<!--                            <label for="username" class="sr-only">username</label>-->
<!--                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">-->
<!--                        </div>-->
<!--                         <div class="form-group">-->
<!--                            <label for="email" class="sr-only">Email</label>-->
<!--                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">-->
<!--                        </div>-->
<!--                         <div class="form-group">-->
<!--                            <label for="password" class="sr-only">Password</label>-->
<!--                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">-->
<!--                        </div>-->
                
<!--                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">-->
<!--                    </form>-->
                 
<!--                </div>-->
<!--            </div> <!-- /.col-xs-12 -->
<!--        </div> <!-- /.row -->
<!--    </div> <!-- /.container -->
<!--</section>-->
<!--</div>-->

        <!--<hr>-->
                  
                
                

            </div>