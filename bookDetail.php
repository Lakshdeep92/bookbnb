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
                  <li><a href="#">Home</a></li>
                  <li class="active">Book Detail</li>
                </ol>
                <div class="product col-md-5 popup-gallery">
                  <div class="bookDetailImageDiv"> <!-- images/1984.jpg -->
                    <a href="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/1929819_1120286934680639_4375030052235240821_n.jpg?oh=f640b178c9f8d1b66871096b8eaf40da&oe=588494E0" class="popupImage"><img src="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/1929819_1120286934680639_4375030052235240821_n.jpg?oh=f640b178c9f8d1b66871096b8eaf40da&oe=588494E0" height="100%" width="100%"></a>
                  </div>
                  <div class="smallImageDiv">
                    <div class="bookDetailSImageDiv"> <!-- images/book_detail_img1.jpg -->
                      <a href="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/1929819_1120286934680639_4375030052235240821_n.jpg?oh=f640b178c9f8d1b66871096b8eaf40da&oe=588494E0" class="popupImage"><img src="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/1929819_1120286934680639_4375030052235240821_n.jpg?oh=f640b178c9f8d1b66871096b8eaf40da&oe=588494E0" height="100%" width="100%"></a>
                    </div>
                    <div class="bookDetailSImageDiv"> <!-- images/book_detail_img2.jpg -->
                      <a href="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/13312632_1168007133241952_5953319755972603106_n.jpg?oh=d5b49f7863a119867004589b7fd897ea&oe=58764B64" class="popupImage"><img src="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/13312632_1168007133241952_5953319755972603106_n.jpg?oh=d5b49f7863a119867004589b7fd897ea&oe=58764B64" height="100%" width="100%"></a>
                    </div>
                    <div class="bookDetailSImageDiv"> <!-- images/book_detail_img3.jpg -->
                      <a href="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/13344563_1168008839908448_3021666593119182819_n.jpg?oh=13561d89a6249569f0c62a47892aec3c&oe=587BAAFB" class="popupImage"><img src="https://scontent-syd1-1.xx.fbcdn.net/v/t1.0-9/13344563_1168008839908448_3021666593119182819_n.jpg?oh=13561d89a6249569f0c62a47892aec3c&oe=587BAAFB" height="100%" width="100%" class="lastImage"></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7 bookDescription">
                  <div class="product-title"><b>1984</b></div>
                  <div class="product-desc">Nineteen Eighty-Four, often published as 1984, is a dystopian novel by English author George Orwell published in 1949. Nineteen Eighty-Four, often published as 1984, is a dystopian novel by English author George Orwell published in 1949.</div>
                  <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
                  <hr>
                  <div class="product-price">$8.00/Month</div>
                  <div class="product-stock">Available</div>
                  <hr>
                  <div class="btn-group cart">
                    <button type="button" class="btn btn-success">
                      Add to cart
                    </button>
                  </div>
                  <div class="btn-group wishlist">
                    <button type="button" class="btn btn-warning">
                      Add to wishlist
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item-container">
            <div class="container comments">
              <div class="col-md-12">
                <div class="col-md-8">
                  <h4 class="headingComments">Renter Comments</h4>
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="userImage">
                          <a href="#"><img src="images/nobody.jpg" class="img-circle"></a>
                        </div>
                        <div>
                          <a href="#" class="usernameComments">Username</a>
                          <p class="comment">Goodness gracious this was very unsettling. I'm already a pretty paranoid person, so the idea of Big Brother was both very intriguing but also extremely frightening.I really enjoyed reading this, but there were moments when I wasn't invested in the story and wanted to take a break from it, mostly in the last half of the book. </p>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="userImage">
                          <a href="#"><img src="images/nobody.jpg" class="img-circle"></a>
                        </div>
                        <div>
                          <a href="#" class="usernameComments">Username</a>
                          <p class="comment">Goodness gracious this was very unsettling. I'm already a pretty paranoid person, so the idea of Big Brother was both very intriguing but also extremely frightening.I really enjoyed reading this, but there were moments when I wasn't invested in the story and wanted to take a break from it, mostly in the last half of the book. </p>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="userImage">
                          <a href="#"><img src="images/nobody.jpg" class="img-circle"></a>
                        </div>
                        <div>
                          <a href="#" class="usernameComments">Username</a>
                          <p class="comment">Goodness gracious this was very unsettling. I'm already a pretty paranoid person, so the idea of Big Brother was both very intriguing but also extremely frightening.I really enjoyed reading this, but there were moments when I wasn't invested in the story and wanted to take a break from it, mostly in the last half of the book. </p>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="userImage">
                          <a href="#"><img src="images/nobody.jpg" class="img-circle"></a>
                        </div>
                        <div>
                          <a href="#" class="usernameComments">Username</a>
                          <p class="comment">Goodness gracious this was very unsettling. I'm already a pretty paranoid person, so the idea of Big Brother was both very intriguing but also extremely frightening.I really enjoyed reading this, but there were moments when I wasn't invested in the story and wanted to take a break from it, mostly in the last half of the book. </p>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                </div>
                <div class="col-md-4">
                  <h4 class="headingComments">Similar Results</h4>
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="moduleImage">
                          <a href="#"><img src="images/book_detail_img1.jpg" class="img-thumbnail"></a>
                        </div>
                        <div>
                          <a href="#" class="similartextLinks"><b>Book Name</b></a><br/>
                          <span class="simpleText">Author - </span><a href="#" class="similartextLinks">Asdasdsa</a><br/>
                          <span class="simpleText">Posted By - </span><a href="#" class="similartextLinks">Asdsfdf</a><br/>
                          <span class="simpleText">Visitors - </span>100<br/>
                          <span class="simpleText">Rating - </span>5<br/>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="moduleImage">
                          <a href="#"><img src="images/book_detail_img2.jpg" class="img-thumbnail"></a>
                        </div>
                        <div>
                          <a href="#" class="similartextLinks"><b>Book Name</b></a><br/>
                          <span class="simpleText">Author - </span><a href="#" class="similartextLinks">Asdasdsa</a><br/>
                          <span class="simpleText">Posted By - </span><a href="#" class="similartextLinks">Asdsfdf</a><br/>
                          <span class="simpleText">Visitors - </span>100<br/>
                          <span class="simpleText">Rating - </span>5<br/>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                  <div class="list-group">
                      <div class="clearfix">
                        <div class="moduleImage">
                          <a href="#"><img src="images/book_detail_img3.jpg" class="img-thumbnail"></a>
                        </div>
                        <div>
                          <a href="#" class="similartextLinks"><b>Book Name</b></a><br/>
                          <span class="simpleText">Author - </span><a href="#" class="similartextLinks">Asdasdsa</a><br/>
                          <span class="simpleText">Posted By - </span><a href="#" class="similartextLinks">Asdsfdf</a><br/>
                          <span class="simpleText">Visitors - </span>100<br/>
                          <span class="simpleText">Rating - </span>5<br/>
                        </div>
                      </div>
                  </div>
                  <hr size="1" width="100%" color="#efefef">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bookComments"></div>

    <?php include "components/learnMore.php" ?>
  </div>
  <!-- searchResults-list -->
  <!-- ========================= book-detail ========================= end -->

</body>

</html>
