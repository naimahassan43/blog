<?php 
  ob_start();
  session_start();
  include "admin/include/db.php";
?>

<?php
  if (isset($_POST['signin'])) {
  	$email    = $_POST['email'];
  	$password = $_POST['password'];

  	 $hassedPass = sha1($password);

      // Find login user from Database
      $sql = "SELECT * FROM subscriber WHERE email='$email' ";
      $user = mysqli_query($db, $sql);

    while( $row = mysqli_fetch_array($user) ){
      $_SESSION['id']           = $row['sub_id'];
      $_SESSION['fullname']     = $row['name'];
      $_SESSION['email']        = $row['email'];
      $_SESSION['dbPassword']   = $row['password'];

      if( $email== $_SESSION['email'] && $hassedPass == $_SESSION['dbPassword'] ){
        header("Location: index.php") ;

      }
      else if( $email != $_SESSION['email'] || $hassedPass != $_SESSION['dbPassword'] ){
        header("Location: index.php");

      }
      else{
        header("Location: index.php");
      }
    }
  }
?>

<?php 
  ob_end_flush();
?>