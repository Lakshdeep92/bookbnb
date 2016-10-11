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
</head>

                    <body>
                      <?php include "components/navbar.php" ?>
                      <!-- begin ========================= book-detail ========================= -->
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
                          <li><a href="books.php">All Books</a></li>
                          <li class="active">Cart</li>
                        </ol>
                        <div class="shopping">
                                    <table id="cart" class="table table-hover table-condensed">
                                      <thead>
                                        <tr>
                                          <th style="width:80%">Product Name</th>
                                          <th style="width:10%">Price</th>
                                          <th style="width:10%"> Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                            if(isset($_SESSION['items'])){
                                                $items = $_SESSION['items'];
                                                $old_price = 0;
                                                foreach($items as $row=>$book_id){
                                                    $book = $obj_Core->getCartBook($book_id, $connection);
                                                    $new_book = $book->fetch_assoc();
                                                    $book_name = $new_book['book_name'];
                                                    $book_image = $new_book['img'];
                                                    $price = $new_book['price'];
                                                    $old_price = $old_price+$price;
                                                    ?>
                                                    <tr>
                                                        <td data-th="Product">
                                                          <div class="row">
                                                              <div class="col-sm-2 hidden-xs"><img src="images/uploads/<?php echo $book_image; ?>" alt="..." style="height: 90px; width: 90px; padding: 6px;" /></div>
                                                            <div class="col-sm-10">
                                                              <h4 class="nomargin"><?php echo $book_name; ?></h4>
                                                            </div>
                                                          </div>
                                                        </td>
                                                        <td data-th="Price">$<?php echo $price; ?></td>
                                                        <td class="actions" data-th="">
                                                            <a href="addtocart.php?id=<?php echo $book_id; ?>"<button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></button></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                    <tr style="margin-top: 20px;">
                                                        <td>
                                                          <div class="row">
                                                            <div class="col-sm-10">
                                                                <a href="books.php"> <button class="btn btn-info btn-sm" style="margin-top: 15px;"><i class="">Continue Shopping</i></button></a>
                                                            </div>
                                                          </div>
                                                        </td>
                                                        <td data-th="Price"><div style="margin-top: 20px;">Total = <strong>$<?php echo $old_price; ?></strong></div></td>
                                                        <td class="actions" data-th="">
                                                            <form action="pay.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="total" value="<?php echo $old_price; ?>">
                                                                <?php
                                                                if(empty($_SESSION['items'])){
                                                                    ?> <button class="btn btn-success btn-sm" style="margin-top: 15px;" disabled="disabled">Checkout</button> <?php
                                                                }else{
                                                                    ?> <button class="btn btn-success btn-sm" style="margin-top: 15px;">Checkout</button>  <?php
                                                                }
                                                                ?>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }else{
                                                ?>
                                                <tr class="myRow">
                                                    <td data-th="Product">
                                                      <div class="row">
                                                        <div class="col-sm-10">
                                                          <h4 class="nomargin">No Items at this time/</h4>
                                                        </div>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                  <?php
                                            }
                                            ?>
                                      </tbody>
                                    </table>   
                                  </div>
<!--                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                              <li>
                                <a href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                </a>
                              </li>
                              <li><a href="#">1</a></li>
                              <li><a href="#">2</a></li>
                              <li><a href="#">3</a></li>
                              <li><a href="#">4</a></li>
                              <li><a href="#">5</a></li>
                              <li>
                                <a href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                </a>
                              </li>
                            </ul>
                          </nav>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <?php include "components/learnMore.php" ?>
          </div>
                                  
                    </body>
                    </html>
<?php
    }
    else{
        header("location: index.php");
    }