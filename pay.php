<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_POST['total'])){
            $total = $_POST['total'];
        }else{
            $total = '0';
        }
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
                        var cardnumber = document.forms["post"]["cardnumber"].value;
                        var cvv = document.forms["post"]["cvv"].value;
                        var expiry = document.forms["post"]["expiry"].value;
                        var firstname = document.forms["post"]["firstname"].value;
                        var lastname = document.forms["post"]["lastname"].value;
                        var address = document.forms["post"]["address"].value;
                        var email = document.forms["post"]["email"].value;
                        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
                        
                        if( cardnumber == null || cardnumber == "" || cardnumber.length < 16 || cardnumber.length > 16){
                          document.getElementById("cardnumber").style.borderColor = "#F44336";
                          return false;
                        }
                        if( cvv == null || cvv == "" || cvv.length < 3 || cvv.length > 3){
                          document.getElementById("cvv").style.borderColor = "#F44336";
                          return false;
                        }
                        if( expiry == null || expiry == ""){
                          document.getElementById("expiry").style.borderColor = "#F44336";
                          return false;
                        }
                        if( firstname == null || firstname == ""){
                          document.getElementById("firstname").style.borderColor = "#F44336";
                          return false;
                        }
                        if( lastname == null || lastname == ""){
                          document.getElementById("lastname").style.borderColor = "#F44336";
                          return false;
                        }
                        if( address == null || address == ""){
                          document.getElementById("address").style.borderColor = "#F44336";
                          return false;
                        }
                         if (!re.test(email)) {
                            document.getElementById("email").style.borderColor = "#F44336";
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
                              <li><a href="cart.php">Cart</a></li>
                              <li class="active">Payment</li>
                            </ol>
                            <h3 class="text-left">Payment Information</h3>
                            <hr>
                            <form class="form form-signup" role="form" action="sucess.php" method="POST" enctype="multipart/form-data" name="post"  onsubmit="return validatePost();" style="width: 50%;">
                              <div class="form-group">
                                <label for="usr">Card Number : <span style="font-size: 12px;font-weight: normal;"> Must be between 16 digits </span></label>
                                <input type="number" class="form-control" id="cardnumber" name="cardnumber">
                              </div>
                              <div class="form-group">
                                  <label for="usr">CVV : <span style="font-size: 12px;font-weight: normal;"> Must be between 3 digits </span></label>
                                <input type="number" class="form-control" id="cvv" name="cvv">
                              </div>
                              <div class="form-group input-group">
                                <label for="usr">Expiry Date (mm/yy):</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" id="expiry" name="expiry">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="usr">First Name :</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                              </div>
                                <div class="form-group">
                                <label for="usr">Last Name :</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                              </div>
                                <div class="form-group">
                                <label for="usr">Address :</label>
                                <input type="text" class="form-control" id="address" name="address">
                              </div>
                                <div class="form-group">
                                <label for="usr">Email :</label>
                                <input type="text" class="form-control" id="email" name="email">
                              </div>
                                <div class="form-group">
                                <label for="usr">Total Amount Paying : $<?php echo $total; ?></label>
                                <input type="hidden" class="form-control" id="total" name="total" value="<?php echo $total; ?>">
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
