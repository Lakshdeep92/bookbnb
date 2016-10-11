<?php
    error_reporting(E_ALL ^ E_NOTICE);
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_GET['isbn'])){
            $isbn = $_GET['isbn'];
            $is_isbn_valid = $obj_Core->checkIsbn($isbn, $connection);
            if($is_isbn_valid->num_rows){
                $book = $obj_Core->getBook($isbn, $connection);
                $book_id = $book['book_id'];
                $bookname = $book['book_name'];
                $isbn = $book['isbn'];
                $price = $book['price'];
                $image = $book['img'];
                $owner_id = $book['owner_id'];
                $date_time = $book['publish_date'];
                $summary = $book['summary'];
                $book_summary = substr($summary, 0, 1000);
                $views = $book['view_count'];
                $obj_Core->incrementView($views, $book_id, $connection);
                $status = $book['status'];
                $g1photo = $book['g1photo'];
                $g2photo = $book['g2photo'];
                $g3photo = $book['g3photo'];
                ?>
                <!DOCTYPE html>
                    <html>
                    <head>
                      <title><?php echo $bookname; ?></title>
                      
                      <?php include "components/head.php" ?>
                      <link rel="stylesheet" type="text/css" href="css/bookDetail.css">
                      <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
                            <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
                            <link rel="stylesheet" type="text/css" href="css/styles.css">
                            <script src="Bootstrap/js/jquery.min.js"></script>
                            <script src="Bootstrap/js/bootstrap.min.js"></script>
                      <!-- Magnific Popup core CSS file -->
                      <link rel="stylesheet" href="css/magnific-popup.css">

                      <!-- Magnific Popup core JS file -->
                      <script src="js/jquery.magnific-popup.js"></script>
                      <script type="text/javascript">
                      $(document).ready(function() {
                        $('.popup-gallery').magnificPopup({
                                    delegate: 'a',
                                    type: 'image',
                                    tLoading: 'Loading image #%curr%...',
                                    mainClass: 'mfp-img-mobile',
                                    gallery: {
                                            enabled: true,
                                            navigateByImgClick: true,
                                            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                                    },
                                    image: {
                                            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                                            titleSrc: function(item) {
                                                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                                            }
                                    }
                            });
                            $( 'a[href="#delete_button"]' ).click(function() {
                                var r = confirm("Are you sure to delete this book?");
                                if(r==true){
                                    window.location.href = "deletebook.php?isbn=<?php echo $isbn; ?>";
                                }
                            });
                            $( 'a[href="#delete_comment"]' ).click(function() {
                                var r = confirm("Are you sure to delete this comment?");
                                if(r==true){
                                    window.location.href = "deletecomment.php?id=<?php echo $comment_id; ?>";
                                }
                            });
                            
                            $('.addtocart').click(function() {

                                $.ajax({
                                 type: "POST",
                                 url: "addtocart.php",
                                 data: { id: <?php echo $book_id; ?> }
                               }).done(function( msg ) {
                                 alert( ""+msg );
                               });    

                           });
                      });
                      </script>
                      <script type="text/javascript">
                        function validateComment(){
                            var comment = document.forms["comment"]["bookComment"].value;
                            if( comment == null || comment == ""){
                                document.getElementById("bookComment").style.borderColor = "#F44336";
                                return false;
                            }
                            return true;
                        }  
                        </script>
                    </head>

                    <body>
                        
                      <?php include "components/navbar.php" ?>
                      <!-- begin ========================= book-detail ========================= -->
                      <div class="book-detail">
                        <div class="bookInfo">
                          <div class="container-fluid">
                            <div class="content-wrapper">
                              <div class="item-container">
                                <div class="container">
                                  <div class="col-md-12">
                                    <ol class="breadcrumb">
                                      <li><a href="index.php">Home</a></li>
                                      <li><a href="books.php">All Books</a></li>
                                      <li class="active"><?php echo $bookname; ?></li>
                                    </ol>
                                    <div class="product col-md-4 popup-gallery">
                                      <div class="bookDetailImageDiv"> <!-- images/1984.jpg -->
                                          <a href="images/uploads/<?php echo $image; ?>" class="popupImage"><img src="images/uploads/<?php echo $image; ?>" height="100%" width="100%"><h6>Click on image to see other pictures</h6></a>
                                            <?php
                                                if(!empty($g1photo)){
                                                    ?><a href="images/uploads/<?php echo $g1photo; ?>" class="popupImage"></a><?php
                                                }
                                            ?>
                                            <?php
                                                if(!empty($g2photo)){
                                                    ?><a href="images/uploads/<?php echo $g2photo; ?>" class="popupImage"></a><?php
                                                }
                                            ?>
                                            <?php
                                                if(!empty($g3photo)){
                                                    ?><a href="images/uploads/<?php echo $g3photo; ?>" class="popupImage"></a><?php
                                                }
                                          ?>
                                          <a href="images/uploads/<?php echo $image; ?>" class="popupImage"></a>
                                          <a href="images/uploads/<?php echo $image; ?>" class="popupImage"></a>
                                      </div>
                                    </div>
                                    <div class="col-md-8 bookDescription">
                                      <div class="product-title">
                                          <b><?php echo $bookname; ?></b>
                                          <?php
                                          if($owner_id == $user_id){
                                              ?>
                                                <a href="#" data-toggle="modal" data-target="#editpost-modal" class="edit_button">Edit</a>
                                                <a href='#delete_button' class="delete_button">Delete</a>
                                              <?php
                                          }
                                          ?>
                                      </div>
                                      <div id="editpost-modal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-body">
                                              <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
                                              <h3 class="text-center">Edit Post</h3>
                                              <form class="form form-signup" role="form" action="editpost.php" method="POST" enctype="multipart/form-data" name="post">
                                                    <div class="form-group">
                                                      <label for="usr">Book Name:</label>
                                                      <input type="text" class="form-control" id="bookname" name="bookname" value="<?php echo $bookname; ?>">
                                                      <input type="hidden" class="form-control" id="p_isbn" name="p_isbn" value="<?php echo $isbn; ?>">
                                                    </div>
                                                    <div class="form-group input-group">
                                                      <label for="usr">Price (AUD):</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="comment">Description:</label>
                                                      <textarea class="form-control" rows="5" id="bookdescription" name="bookdescription"><?php echo $summary; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <h4 style="color: #ff0000;"> * If you do not change images than they will remain same</h4>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputFile">Upload Cover Photo:</label>
                                                      <input type="file" id="coverphoto" name="coverphoto">
                                                    </div>
                                                    <div class="form-group">
                                                        <h6> * Please Upload Three Gallery Photos as Well (optional)</h6>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputFile">Upload Gallery Photo:</label>
                                                      <input type="file" id="g1photo" name="g1photo">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputFile">Upload Gallery Photo:</label>
                                                      <input type="file" id="g2photo" name="g2photo">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputFile">Upload Gallery Photo:</label>
                                                      <input type="file" id="g3photo" name="g3photo">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">POST</button>
                                                    </div>
                                                  </form>
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                      <div class="product-desc"><?php echo $book_summary; ?><p style="text-align: left; margin-top: 5px;"> Published on - <?php echo $date_time; ?> &nbsp;&nbsp; Views - <?php echo $views; ?> &nbsp;&nbsp; ISBN : <?php echo $isbn; ?></p><p style="text-align: left; margin-top: 5px;"> </p></div>
                                      <div class="product-price">$<?php echo $price; ?>/Month</div>
                                        <hr>
                                        <?php
                                        if($status==1){
                                            ?>
                                            <div class="btn-group cart">
                                                <button type="button" class="btn btn-success addtocart">
                                                  Add to cart
                                                </button>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="btn-group cart">
                                                <button type="button" class="btn btn-success addtocart" disabled="disabled">
                                                  Add to cart
                                                </button>
                                            </div>
                                            <p class="bg-danger" style="color: #F44336  !important; width: 20%; margin-top: 5px;">* Not Available !</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="item-container">
                                <div class="container comments">
                                  <div class="col-md-12">
                                    <div class="col-md-8">
                                      <h4 class="headingComments">Add Comment</h4>
                                      <div class="commentForm">
                                          <form class="form form-signup" role="form" action="addcomment.php" method="POST" enctype="multipart/form-data" name="comment" onsubmit="return validateComment();">
                                          <div class="form-group">
                                            <textarea class="form-control" rows="5" id="bookComment" name="bookComment" placeholder="Comment Here"></textarea>
                                            <input type="hidden" class="form-control" id="book_id" name="book_id" value="<?php echo $book_id; ?>">
                                            <input type="hidden" class="form-control" id="book_isbn" name="book_isbn" value="<?php echo $isbn; ?>">
                                          </div>
                                          <div class="form-group">
                                              <button type="submit" class="btn btn-primary"> POST COMMENT</button>
                                          </div>
                                        </form>
                                      </div>
                                      <h4 class="headingComments">Renter Comments</h4>
                                      <?php
                                      $getComments = $obj_Core->getComments($book_id, $connection);
                                      if($getComments->num_rows){
                                          while($comment = $getComments->fetch_assoc()){
                                              $comment_id = $comment['comment_id'];
                                              $comment_user_id = $comment['user_id'];
                                              $comment_username = $obj_Core->getUserName($comment_user_id, $connection);
                                              $user_id = $obj_Core->getId();
                                              $comment_summary = $comment['comment'];
                                              $comment_time = $comment['comment_time'];
                                              $profileImage = $obj_Core->getImage($comment_user_id, $connection);
                                              ?>
                                               <div class="list-group">
                                                    <div class="clearfix">
                                                      <div class="userImage">
                                                          <a href="profile.php?id=<?php echo $comment_user_id; ?>"><img src="images/profile/<?php echo $profileImage; ?>" class="img-circle"></a>
                                                      </div>
                                                      <div>
                                                          <?php
                                                            $isOwner = $obj_Core->isCommentOwner($user_id,$comment_user_id);
                                                            if($isOwner){
                                                                ?><a href="deletecomment.php?id=<?php echo $comment_id; ?>&isbn=<?php echo $isbn; ?>" class="delete_comment"><span class="glyphicon glyphicon-remove" style="float: right; color: #F44336;"></span></a><?php
                                                            }else{
                                                                
                                                            }
                                                          ?>
                                                        <a href="#" class="usernameComments"><?php echo $comment_username; ?></a>
                                                        <p class="comment"><?php echo $comment_summary; ?></p>
                                                        <h6><?php echo $comment_time; ?></h6>
                                                      </div>
                                                    </div>
                                                </div>
                                                <hr size="1" width="100%" color="#efefef">
                                      
                                              <?php
                                          }
                                      }else{
                                            ?>
                                                
                                                <div class="list-group">
                                                    <div class="clearfix">
                                                      <div>
                                                        <p class="comment" style="margin-left: 10px;">No Comments</p>
                                                      </div>
                                                    </div>
                                                </div>
                                                <hr size="1" width="100%" color="#efefef">
                                                
                                            <?php
                                      }
                                      ?>
                                    </div>
                                    <div class="col-md-4">
                                      <h4 class="headingComments">Most Viewed</h4>
                                      <?php
                                      
                                      $mostviewed = $obj_Core->getMostViewedBooks($connection);
                                      while($mostviewed_book = $mostviewed->fetch_assoc()){
                                          $mostviewed_bookname = $mostviewed_book['book_name'];
                                          $mostviewed_img = $mostviewed_book['img'];
                                          $mostviewed_owner_id = $mostviewed_book['owner_id'];
                                          $mostviewed_username = $obj_Core->getUserName($mostviewed_owner_id, $connection);
                                          $mostviewed_viewcount = $mostviewed_book['view_count'];
                                          $mostviewed_price = $mostviewed_book['price'];
                                          $mostviewed_isbn = $mostviewed_book['isbn'];
                                          ?>
                                      
                                          <div class="list-group">
                                                <div class="clearfix">
                                                  <div class="moduleImage">
                                                      <a href="viewbook.php?isbn=<?php echo $mostviewed_isbn; ?>"><img src="images/uploads/<?php echo $mostviewed_img; ?>" class="img-thumbnail"></a>
                                                  </div>
                                                  <div>
                                                    <a href="viewbook.php?isbn=<?php echo $mostviewed_isbn; ?>" class="similartextLinks"><b><?php echo $mostviewed_bookname; ?></b></a><br/>
                                                    <span class="simpleText">Posted By - </span><a href="profile.php?id=<?php echo $mostviewed_owner_id; ?>" class="similartextLinks"><?php echo $mostviewed_username; ?></a><br/>
                                                    <span class="simpleText">Price - </span><?php echo $mostviewed_price; ?><br/>
                                                    <span class="simpleText">Visitors - </span><?php echo $mostviewed_viewcount; ?><br/>
                                                  </div>
                                                </div>
                                            </div>
                                            <hr size="1" width="100%" color="#efefef">
                                          <?php
                                      }
                                      ?>
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
                header("location: books.php");
            }
        }else{
            header("location: books.php");
        }
    }else{
        header("location: index.php");
    }
