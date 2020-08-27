<?php 
include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Right Sidebar</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Single Posts -->
                <div class="col-md-8">

                    <?php

                    if(isset($_GET['post'])){

                        $postID   = $_GET['post'];

                        $sql      = "SELECT * FROM post WHERE id ='$postID' ";
                        $readPost = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_assoc($readPost) ){

                          $id             = $row['id'];
                          $title          = $row['title'];
                          $description    = $row['description'];
                          $image          = $row['image'];
                          $category_id    = $row['category_id'];
                          $author_id      = $row['author_id'];
                          $status         = $row['status'];
                          $tags           = $row['tags'];
                          $post_date      = $row['post_date'];

                          ?>
                     <div class="blog-single">
                        <!-- Blog Title -->
                        <h3 class="post-title"><?php echo $title; ?></h3>

                        <!-- Blog Categories -->
                        <div class="single-categories">
                            
                         <?php

                                $sql = "SELECT * FROM category WHERE cat_id=' $category_id' ";
                                $catDetails = mysqli_query($db, $sql);
    
                            while ( $row=mysqli_fetch_assoc($catDetails) ){

                                 $cat_id    = $row['cat_id'];
                                 $cat_name  = $row['cat_name'];

                            ?>
                                <span><?php echo $cat_name ;?></span>

                            <?php }?>
                        </div>
                        
                        <!-- Blog Thumbnail Image Start -->
                        <div class="blog-banner">
                            <img src="admin/img/post/<?php echo $image; ?>">
                        </div>
                        <!-- Blog Thumbnail Image End -->

                        <!-- Blog Description Start -->
                        <p><?php echo $description; ?></p>

                        <!-- Blog Description End -->
                    </div>


                    <?php    }

                    }
                    ?>

                   <div class="row">
                       <div class="col-md-12">
                        <?php 

                        if (!empty($_SESSION['email'])) {?>
                           

                            <!-- Post New Comment Section Start -->
                            <div class="post-comments">
                                
                             <h4>Post Your Comments</h4>
                                <div class="title-border"></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                <!-- Form Start -->
                                <form action="" method="POST" class="contact-form">


                                    <!-- Right Side Start -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Comments Textarea Field -->
                                            <div class="form-group">
                                                <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                                <i class="fa fa-pencil-square-o"></i>
                                            </div>
                                            <!-- Post Comment Button -->
                                            <button type="submit" class="btn-main" name="postComment"><i class="fa fa-paper-plane-o"></i> Post Your Comments</button>
                                        </div>
                                    </div>
                                    <!-- Right Side End -->
                                </form>
                                <!-- Form End -->
                            </div>
                            <!-- Post New Comment Section End --> 

                             <?php  }
                             else{?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="post-comments">
                                             <?php  echo '<a href="signUp.php"  class= "text-primary">Please Login to post your Comment.</a>';?>
                                        </div> 
                                   </div>
                                </div>

                               
                            <?php }
                            ?> 

                    <?php

                    if (isset($_POST['postComment'])) {

                        $name        = $_SESSION['fullname'];
                        $user_image  = $_SESSION['user_image']; 
                        $comments    = mysqli_real_escape_string($db, $_POST['comments']);
                        $post_id     = $id;

                        $sql = "INSERT INTO comments (name, user_image, comments, post_id, status, c_date) VALUES ('$name','$user_image','$comments', '$post_id', '0', now() )";
                        // echo $sql;
                        
                        $addComment = mysqli_query($db,$sql);

                        if ($addComment){
                              header("Location: single.php?post=$post_id");
                            }
                            else{
                              die("System Error. Please contact with web Administrator" . mysqli_error($db) );
                            }

                       
                    }

                    ?>
               </div>
           </div>


                <!-- Single Comment Section Start -->
                <div class="single-comments">
                    <!-- Comment Heading Start -->
                    <div class="row">
                        <div class="col-md-12">

                            <?php 

                            $sql = "SELECT * FROM comments WHERE post_id = '$postID' AND status =1 ORDER BY c_id DESC";
                            $read_comments = mysqli_query($db, $sql);
                            $commentNumber = mysqli_num_rows($read_comments);

                            ?>

                            <h4>All Latest Comments (<?php echo $commentNumber;?>)</h4>
                            <div class="title-border"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        </div>
                    </div>
                    <!-- Comment Heading End -->

                    <?php 

                    if ( $commentNumber == 0 ){
                        echo '<div class="alert alert-warning">Opps!! No Comment Found Yet</div>';
                    }

                    else {
                        while($row = mysqli_fetch_assoc($read_comments)) {
                            $c_id       = $row['c_id'];
                            $name       = $row['name'];
                            $user_image = $row['user_image'];
                            $comments   = $row['comments'];
                            $post_id    = $row['post_id'];
                            $status     = $row['status'];
                            $c_date     = $row['c_date'];
                            ?>


            <!-- Single Comment Post Start -->
            <div class="row each-comments">
                <div class="col-md-2">
                    <!-- Commented Person Thumbnail -->
                    <div class="comments-person">

                        <img src="assets/images/corporate-team/team-1.jpg">
                         
                
                    </div>
                </div>

                <div class="col-md-10 no-padding">
                    <!-- Comment Box Start -->
                    <div class="comment-box">
                        <div class="comment-box-header">
                            <ul>
                                <li class="post-by-name"><?php echo $name;?></li>
                                <li class="post-by-hour"><?php echo $c_date;?></li>
                            </ul>
                        </div>
                        <p><?php echo $comments;?></p>
                    </div>
                    <a href="single.php?post=<?php echo $postID;?>&reply=<?php echo $c_id;?>"><i class="fa fa-comments"></i>Reply</a>
                    <!-- Comment Box End -->
                    <?php 
                      if ( isset($_GET['reply'])){
                        $replyId = $_GET['reply'];

                        ?>

                        <form action="" method="POST" class="contact-form">


                        <!-- Right Side Start -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Comments Textarea Field -->
                                <div class="form-group">
                                    <textarea name="comments" class="form-input" placeholder="Your Comments Here..." rows="2"></textarea>
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                                <!-- Post Comment Button -->
                                <button type="hidden" name="reply_id" value="<?php echo $replyId;?>"></button>
                                <button type="submit" class="btn-main" name="replyPostComment"><i class="fa fa-paper-plane-o"></i> Post Your Comments</button>
                            </div>
                        </div>
                        <!-- Right Side End -->
                    </form>

                    <?php } ?>
                    <?php

                     if (isset($_POST['replyPostComment'])) {

                    $name        = $_SESSION['fullname'];
                    $image       = $_SESSION['user_image'];
                    $comments    = mysqli_real_escape_string($db, $_POST['comments']);
                    $post_id     = $id;
                    $r_id        = $_POST['reply_id'];

                    $sql = "INSERT INTO comments (r_id, name, user_image, comments, post_id, status, c_date) VALUES ('$r_id', '$name','$image','$comments', '$post_id', '1', now() )";
                   
                    $addReply = mysqli_query($db,$sql);

                    if ($addReply){
                          header("Location: single.php?post=$post_id");
                        }
                        else{
                          die("System Error. Please contact with web Administrator" . mysqli_error($db) );
                        }
                    }

                ?>
                </div>
            </div>
            <!-- Single Comment Post End -->


            <?php    }
            }


            ?>
            

            
        </div>
        <!-- Single Comment Section End -->

        </div>




                <!-- Blog Right Sidebar -->
               <?php include"inc/sidebar.php";?>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    



    <?php include"inc/footer.php";?>