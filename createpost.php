<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
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
              });
              </script>
              <script type="text/javascript">
                  function validatePost(){
                        var bookname = document.forms["post"]["bookname"].value;
                        var isbn = document.forms["post"]["isbn"].value;
                        var price = document.forms["post"]["price"].value;
                        var description = document.forms["post"]["bookdescription"].value;
                        var coverphoto = document.forms["post"]["coverphoto"].value;
                        
                        if( bookname == null || bookname == ""){
                          document.getElementById("bookname").style.borderColor = "#F44336";
                          return false;
                        }
                        if( isbn == null || isbn == "" || isbn.length < 10 || isbn.length > 13){
                          document.getElementById("isbn").style.borderColor = "#F44336";
                          return false;
                        }
                        if( price == null || price == ""){
                          document.getElementById("price").style.borderColor = "#F44336";
                          return false;
                        }
                        if( description == null || description == ""){
                          document.getElementById("bookdescription").style.borderColor = "#F44336";
                          return false;
                        }
                        if( coverphoto == null || coverphoto == ""){
                           alert("Please choose an Image");
                          document.getElementById("coverphoto").style.borderColor = "#F44336";
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
                              <li class="active">Create Post</li>
                            </ol>
                              <?php
                              if(isset($_GET['r'])){
                                  $r = $_GET['r'];
                                  if($r == 'f'){
                                      ?> <p class="bg-danger" style="color: #F44336  !important; width: 50%;">* Please Try Again !</p> <?php
                                  }
                              }
                              ?>
                            <h3 class="text-left">Post New Book</h3>
                            <form class="form form-signup" role="form" action="postscript.php" method="POST" enctype="multipart/form-data" name="post"  onsubmit="return validatePost();" style="width: 50%;">
                              <div class="form-group">
                                <label for="usr">Book Name:</label>
                                <input type="text" class="form-control" id="bookname" name="bookname">
                              </div>
                              <div class="form-group">
                                  <label for="usr">ISBN: <span style="font-size: 12px;font-weight: normal;"> Must be between 10 to 13 digits </span></label>
                                <input type="number" class="form-control" id="isbn" name="isbn">
                              </div>
                              <div class="form-group input-group">
                                <label for="usr">Price (AUD):</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                  <input type="number" class="form-control" id="price" name="price">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="comment">Description:</label>
                                <textarea class="form-control" rows="5" id="bookdescription" name="bookdescription"></textarea>
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
?>
