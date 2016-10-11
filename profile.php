<?php
error_reporting(E_ALL ^ E_NOTICE);
require 'class.Core.inc';
$obj_Core = new Core();
$connection = $obj_Core->connect_Database();
$check_Session = $obj_Core->checkSession();
if ($check_Session) {
    $user_id = $_SESSION['user_id'];
    $username = $obj_Core->getUserName($user_id, $connection);
    $shortUsername = substr($username, 0, 7);
    if(isset($_GET['id'])&&!empty($_GET['id'])){
        $id = $_GET['id'];
        $userRow = $obj_Core->getUser($id, $connection);
        $userEmail = $userRow['email'];
        $userAddress = $userRow['street']." , ".$userRow['suburb']." , ".$userRow['state'];
        $userPostcode = $userRow['postcode'];
        $userImage = $obj_Core->getImage($id, $connection);
        $getPostCount = $obj_Core->getPostCount($id, $connection);
        $getReviewsCount = $obj_Core->getReviewsCount($id, $connection);
?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Search Result</title>
                    <?php include "components/head.php" ?>
                    <link rel="stylesheet" type="text/css" href="css/bookDetail.css">
                    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
                    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
                    <link rel="stylesheet" type="text/css" href="css/styles.css">
                    <script src="Bootstrap/js/jquery.min.js"></script>
                    <script src="Bootstrap/js/bootstrap.min.js"></script>
                </head>

                <body>
                    <?php include "components/navbar.php" ?>

                    <!-- begin ========================= book-detail ========================= -->
                    <div class="book-detail">
                        <div class="bookInfo">
                            <div class="container-fluid">
                                <div class="content-wrapper">
                                    <div class="item-container">
                                        <div class="container" style="min-height: 600px;">
                                            <div class="col-md-12">
                                                <ol class="breadcrumb">
                                                    <li><a href="index.php">Home</a></li>
                                                    <li class="active">Profile</li>
                                                </ol>
                                                <hr>
                                                <div class="wrapperProfile col-md-3">
                                                    <div class="profileImageBlock">
                                                        <img src="images/profile/<?php echo $userImage; ?>" class="img-thumbnail profileImage">
                                                        <a href="#" data-toggle="modal" data-target="#photo-modal"><p>Upload profile photo</p></a>
                                                        <h3 class="profile-username text-center"><?php echo $username; ?></h3>
                                                        <ul class="list-group list-group-unbordered">
                                                            <li class="list-group-item">
                                                              <b>Posts</b> <a class="pull-right"><?php echo $getPostCount; ?></a>
                                                            </li>
                                                            <li class="list-group-item">
                                                              <b>Reviews</b> <a class="pull-right"><?php echo  $getReviewsCount; ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="photo-modal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                          <!-- Modal content-->
                                                          <div class="modal-content">
                                                            <div class="modal-body">
                                                              <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
                                                              <h3 class="text-center">Profile Picture</h3>
                                                              <form class="form form-signup" role="form" action="uploadImage.php" method="POST" enctype="multipart/form-data" name="image">
                                                                <div class="form-group">
                                                                  <div class="input-group">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span>
                                                                    </span>
                                                                    <input type="file" id="profileImage" name="profileImage" class="form-control" placeholder="Profile Image" />
                                                                    <input type="hidden" id="profileID" name="profileID" class="form-control" placeholder="Email" />
                                                                  </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Upload</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div> 
                                                    <div class="box box-primary">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">About Me 
                                                            <?php
                                                            if($id==$user_id){
                                                                ?> <a href="#" data-toggle="modal" data-target="#editprofile-modal">Edit</a> <?php
                                                            }?> </h3>
                                                        </div>
                                                        <div id="editprofile-modal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                          <!-- Modal content-->
                                                          <div class="modal-content">
                                                            <div class="modal-body">
                                                              <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
                                                              <h3 class="text-center">Edit Profile</h3>
                                                              <form class="form form-signup" role="form" action="editProfile.php" method="POST" enctype="multipart/form-data" name="signup">
                                                                   
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                                            <input type="text" id="street" name="street" class="form-control" value="<?php echo $userRow['street']; ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                                            <input type="text" id="suburb" name="suburb" class="form-control" value="<?php echo $userRow['suburb']; ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                                            <input type="text" id="state" name="state" class="form-control" value="<?php echo $userRow['state']; ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                                            <input type="number" id="postcode" name="postcode" class="form-control" value="<?php echo $userRow['postcode']; ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary btn-sm btn-block">SUBMIT</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <strong><i class="glyphicon glyphicon-envelope"></i> Email</strong>
                                                            <p class="text-muted" style="text-align: left !important;">
                                                              <?php echo $userEmail; ?>
                                                            </p>
                                                            <hr>
                                                            <strong><i class="glyphicon glyphicon-road"></i> Location</strong>
                                                            <p class="text-muted" style="text-align: left !important;"><?php echo $userAddress; ?></p>
                                                            <hr>
                                                            <strong><i class="glyphicon glyphicon-barcode"></i> Postcode</strong>
                                                            <p class="text-muted" style="text-align: left !important;"><?php echo $userPostcode; ?></p>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <?php
                                                    if($id==$user_id){
                                                        
                                                    }else{
                                                        ?>
                                                            <div class="box box-primary">
                                                                <div class="box-header with-border">
                                                                  <h3 class="box-title">Add Review</h3>
                                                                </div>
                                                                <!-- /.box-header -->
                                                                <div class="box-body">
                                                                    <form action="addReview.php" method="POST" name="review">
                                                                        <textarea style="height: 100px; width: 210px;" name="reviewComment"></textarea>
                                                                        <input type="hidden" name="to" value="<?php echo $id; ?>">
                                                                        <button type="submit">Submit</button>
                                                                    </form>
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="headingComments" style="margin: 0px; border-radius: 0px;">Posts</h3>
                                                    <ul class="list-group">
                                                        <?php
                                                        $getUserBooks = $obj_Core->getUserBooks($id, $connection);
                                                        if($getUserBooks->num_rows){
                                                        while($userBooks = $getUserBooks->fetch_assoc()){
                                                            $title = $userBooks['book_name'];
                                                            $isbn = $userBooks['isbn'];
                                                            $price = $userBooks['price'];
                                                            $image = $userBooks['img'];
                                                            $summary = $userBooks['summary'];
                                                            $short_summary = substr($summary, 0,130);
                                                            $views = $userBooks['view_count'];
                                                        ?>
                                                        <li class="list-group-item books" style="margin: 0px; border-radius: 0px; width: 100%; height: 250px;">
                                                            <a href="viewbook.php?isbn=<?php echo $isbn; ?>">
                                                                <div width="100%">
                                                                    <div width="30%" style="float: left; margin-right: 15px;">
                                                                        <img src="images/uploads/<?php echo $image; ?>" class="books_image">
                                                                    </div>
                                                                    <div class="books_detail" width="70%" style="margin-left: 15px;">
                                                                        <h4><?php echo $title; ?></h4>
                                                                        <p><?php echo $short_summary; ?>..</p>
                                                                        <p>Views: <?php echo $views; ?> &nbsp; ISBN: <?php echo $isbn; ?> &nbsp; Price: $<?php echo $price; ?>/month </p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <?php
                                                        }
                                                        }else{
                                                            ?><li class="list-group-item books" style="margin: 0px; border-radius: 0px; width: 100%; height: 250px;">
                                                            <p style="text-align: left; margin-left: 15px;"> No Posts to show</p>
                                                        </li><?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <h3 class="headingComments" style="margin: 0px; border-radius: 0px;">Reviews</h3>
                                                    <ul class="list-group">
                                                        <?php
                                                            $getReviews = $obj_Core->getReviews($id, $connection);
                                                            if($getReviews->num_rows){
                                                                while($reviews = $getReviews->fetch_assoc()){
                                                                    $comment_from = $reviews['comment_from'];
                                                                    $comment = $reviews['comment'];
                                                                    $comment_username = $obj_Core->getUserName($comment_from, $connection);
                                                                    $user_profile_image = $obj_Core->getImage($comment_from, $connection);
                                                                    ?>
                                                                        <li class="list-group-item books" style="margin: 0px; border-radius: 0px; height: 120px;">
                                                                                <div>
                                                                                    <div class="col-md-2">
                                                                                        <img src="images/profile/<?php echo $user_profile_image; ?>" class="img-circle" height="90px" width="90px">
                                                                                    </div>
                                                                                    <div class="col-md-10 books_detail">
                                                                                        <h4><?php echo $comment_username; ?></h4>
                                                                                        <p><?php echo $comment; ?></p>
                                                                                    </div>
                                                                                </div>
                                                                        </li>
                                                                    <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                <li class="list-group-item books" style="margin: 0px; border-radius: 0px; height: 120px;">
                                                                    <p style="text-align: left; margin-left: 15px;"> No Reviews to show</p>
                                                                        </li>
                                                                <?php
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php include "components/learnMore.php" ?>
                    </div>
                    <!-- searchResults-list -->
                    <!-- ========================= book-detail ========================= end -->
                </body>
            </html>

            <?php
    }else{
        header("location: index.php");
    }
} else {
    header("location: index.php");
}
