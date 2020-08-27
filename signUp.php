<?php 
include "inc/header.php";
?>
<section>
	<!-- Post New Comment Section Start -->
  <div class="post-comments">
     <div class="row justify-content-center">
<!-- Registered input field -->
     	<div class="col-md-6">
     		<h4>Get Registered</h4>
		      <div class="title-border"></div>
		      <form action="" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<input type="text" name="fullname" placeholder="Your Name" class="form-input" autocomplete="off" required="required"> <i class="fa fa-user-o"></i>
						</div>

						<div class="form-group">
							<input type="email" name="email" placeholder="Your Email Address" class="form-input" autocomplete="off" required="required"> <i class="fa fa-envelope-o"></i>
						</div>

						<div class="form-group">
							<input type="password" name="password" placeholder="Your Password" class="form-input" autocomplete="off" required="required">
                <i class="fa fa-lock"></i>
						</div>

						<div class="form-group">
              <input type="file" name="image" class="form-control-file">
              
            </div>

						<div class="form-group">
                <input type="submit" class="btn-main" value="Sign Up" name="signup">
            </div> 
		      </form>
     	</div>

    <?php
    	if(isset($_POST['signup'])){
    		
        $name       			= $_POST['fullname']; 
        $email 						= $_POST['email'];
        $password 				= $_POST['password'];
       
        $userImage       = $_FILES['image']['name'];
        $userImageTmp    = $_FILES['image']['tmp_name'];


          if ( !empty($userImage)){

          // Change the Image File Name
          $userImage = rand(0,5000000) .'_'. $userImage;
          move_uploaded_file($userImageTmp,"admin/img/subscriber/".$userImage);

          $sql = "INSERT INTO subscriber (name, user_image, email, password) VALUES ('$name','$userImage', '$email', '$password')";
          
          $addSubsciber = mysqli_query($db, $sql);
         
          
          if ($addSubsciber){
            header("Location: index.php");
          }
          else{
            die("MySQLi Error." . mysqli_error($db) );
          }

        }

        else{
          $sql = "INSERT INTO subscriber (name, email, password) VALUES ('$name', '$email', '$password')";
          
          $addSubsciber = mysqli_query($db, $sql);
          
          if ($addSubsciber){
            header("Location: index.php");
          }
          else{
            die("MySQLi Error." . mysqli_error($db) );
          }
        }
    	}

    ?>

     	<!-- Email Address input field -->
     	<!-- <div class="col-md-6">
     		<h4>Login</h4>
		      <div class="title-border"></div>
		      <form action="login.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" class="form-input" autocomplete="off" required="required">
                <i class="fa fa-envelope-o"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Your Password" class="form-input" autocomplete="off" required="required">
                <i class="fa fa-lock"></i>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-main" value="Sign In" name="signin">
            </div> 
        	</form>
     	</div> -->
     </div> 
   
  </div>
  <!-- Post New Comment Section End --> 
</section>
<?php include"inc/footer.php";?>