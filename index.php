<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
     
<style>
        article .likedislike .firstone{
        background: #f6f6f6;
        border-radius: 5px;
        padding-right: 35px;
        padding-left: 35px;
        display: flex;
        width: 17.6rem;
    } 
      article .likedislike .firstone i{
        font-size: 26px;
        color: #000;
        
    }
    article .likedislike .firstone span{
        padding-top: 10px;
        
    }
    article .likedislike .firstone .likeleft{        
     padding-left: 10px;   
    }
    article .likedislike .firstone .disright{
        padding-right: 10px;
    }
  
    article .likedislike #dislike{
        padding-left: 20px;
    }
    article .likedislike #like:after{
        content: '';
        border-left: 2px solid #d3d3d3;
        height: 37px;
        margin-left: 10px;
        position: absolute;
        margin-top: -10px;
    }
    @media screen and (max-width: 768px){
        article .likedislike .firstone i{
        font-size: 22px;
        
    }
        article .likedislike #like:after{
        content: '';
        border-left: 2px solid #d3d3d3;
        height: 32px;
        margin-left: 10px;
        position: absolute;
        margin-top: -10px;
    }
        article .likedislike .firstone{       
        padding-right: 35px;
        padding-left: 24px;
        width: 15rem;
    }
    }
    
</style>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                        <h1 class="page-header">
                        WELCOME TO KABIR'S BlOG
                        <!-- <small>Farhad</small> -->
                        </h1>
                        <?php 

                        $per_page = 5;

                        if(isset($_GET['page'])){

                        $page = $_GET['page'];   

                        }else{

                        $page = "";  

                        }
                        if($page == "" || $page == 1){

                        $page_1 = 0;  

                        }else{

                        $page_1 =  ($page * $per_page) - $per_page;  

                        }

                        $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                        $pagination_query = mysqli_query($connection,$query);
                        $post_count = mysqli_num_rows($pagination_query);        
                        $count = ceil($post_count / $per_page); 

                        $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, $per_page ";
                        $select_all_posts = mysqli_query($connection,$query);
                        if(mysqli_num_rows($select_all_posts) < 1){

                            echo "<h1 class='text-center'>NO POSTS AVAILABLE SORRY</h1>";

                        }else{

                    if(mysqli_num_rows($select_all_posts)>0){
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_id      = $row['post_id'];
                        $post_title   = $row['post_title'];
                        $post_author  = $row['post_user'];
                        $post_date    = $row['post_date'];
                        $post_image   = $row['post_image'];
                        $like_count   = $row['like_count'];
                        $dislike_count= $row['dislike_count'];  
                        $post_content = substr($row['post_content'], 0,200);
                        $post_status  = $row['post_status'];

                        $likeClass="ri-thumb-up-line";	
                        if(isset($_COOKIE['like_'.$row['post_id']])){
                        $likeClass="ri-thumb-up-fill";
                        }		
                        $dislikeClass="ri-thumb-down-line";	
                        if(isset($_COOKIE['dislike_'.$row['post_id']])){
                        $dislikeClass="ri-thumb-down-fill";
                        }
                        ?>
        <!-- First Blog Post -->
        <h2>
        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;  ?></a>
        </h2>
        <p class="lead">
        by <a href="author_posts.php?author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_author;  ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;  ?></p>
        <hr>
        <a href="post.php?p_id=<?php echo $post_id;  ?>">
        <img class="img-responsive img-fluid" src="images/<?php echo $post_image;  ?>" alt="">
        </a>
        <hr>
        <article id="post<?php echo $post_id;?>">       
        <div class="likedislike">
        <span class="firstone">
        <i class="<?php echo $likeClass;?> textone" onclick="setLikeDislike('like','<?php echo $post_id;?>')" id="like_<?php echo $post_id;?>"></i> <span id="like" class="likeleft"><?php echo $like_count;?></span>   
        
       <span id="dislike" class="disright"><?php echo $dislike_count;?></span> <i class="<?php echo $dislikeClass;?> texttow" onclick="setLikeDislike('dislike','<?php echo $post_id;?>')" id="dislike_<?php echo $post_id;?>"></i>
          </span>
        </div>            
        </article>
        
        <hr>
        <p><?php echo $post_content;  ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;  ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
        <?php 	} }else{ echo "data not found";} }  ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->
        <hr>                                        
           

                        <ul class="pager">

                        <?php 

                        for($i = 1;$i <= $count; $i++){

                        if($i == $page){

                        echo "<li><a class='active_link' style='color: white;' href='index.php?page={$i}'>$i</a></li>";   

                        }else{

                        echo "<li><a href='index.php?page={$i}'>$i</a></li>";     
                            
                        }
                        }

                        ?>  

                        </ul>

         <?php include "includes/footer.php"; ?>
         
             <script>                    
	  function setLikeDislike(type,post_id){
		  jQuery.ajax({
			  url:'setLikeDislike.php',
			  type:'post',
			  data:'type='+type+'&post_id='+post_id,
			  success:function(result){
              result=jQuery.parseJSON(result);
				  if(result.opertion=='like'){
                      jQuery('#like_'+post_id).removeClass('ri-thumb-up-line');
                      jQuery('#like_'+post_id).addClass('ri-thumb-up-fill');
                      jQuery('#dislike_'+post_id).addClass('ri-thumb-down-line');
                      jQuery('#dislike_'+post_id).removeClass('ri-thumb-down-fill');
				  }
				  if(result.opertion=='unlike'){
					  jQuery('#like_'+post_id).addClass('ri-thumb-up-line');
					  jQuery('#like_'+post_id).removeClass('ri-thumb-up-fill');
				  }				  
				  if(result.opertion=='dislike'){
                      jQuery('#dislike_'+post_id).removeClass('ri-thumb-down-line');
                      jQuery('#dislike_'+post_id).addClass('ri-thumb-down-fill');
                      jQuery('#like_'+post_id).addClass('ri-thumb-up-line');
                      jQuery('#like_'+post_id).removeClass('ri-thumb-up-fill');
				  }
				  if(result.opertion=='undislike'){
					  jQuery('#dislike_'+post_id).addClass('ri-thumb-down-line');
					  jQuery('#dislike_'+post_id).removeClass('ri-thumb-down-fill');
				  }				  				  
				      jQuery('#post'+post_id+' #like').html(result.like_count);
				      jQuery('#post'+post_id+' #dislike').html(result.dislike_count);
			  }			  
		  });
	  }
	  </script>   
	  
                            