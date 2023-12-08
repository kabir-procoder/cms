<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>


    <section id="send">
        <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Contact Us</h1>

                    <form role="form"  action="https://formspree.io/f/xbjeklyv"
  method="POST" autocomplete="off">
<!--                        onsubmit="sendEmail(); reset(); return false;"-->
                        <div class="form-group">

                            <input type="text" name="name" id="username" class="form-control" placeholder="Enter your Name" required>
                        </div>
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">

                          <textarea class="form-control" placeholder="Write your message" name="message" id="body" cols="42" rows="5" required></textarea>            
                            
                        </div>
                        <input type="submit" name="submit" id="send" class="btn btn-custom btn-lg btn-block btn-primary" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div><!-- /.row -->
    </div>
    <!-- /.container -->
</section>





