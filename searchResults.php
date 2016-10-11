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
    if (isset($_POST)) {
        $search = $_POST['searchInput'];
        if (!empty($search)) {
            $books = $obj_Core->searchBooks($search, $connection);
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
                        $(document).ready(function () {
                            $('.popup-gallery').magnificPopup({
                                delegate: 'a',
                                type: 'image',
                                tLoading: 'Loading image #%curr%...',
                                mainClass: 'mfp-img-mobile',
                                gallery: {
                                    enabled: true,
                                    navigateByImgClick: true,
                                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                                },
                                image: {
                                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                                    titleSrc: function (item) {
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
                                        <div class="container" style="min-height: 600px;">
                                            <div class="col-md-12">
                                                <ol class="breadcrumb">
                                                    <li><a href="index.php">Home</a></li>
                                                    <li class="active">Search Results</li>
                                                </ol>
                                                <h3> Search Results for " <?php echo $search; ?> "</h3>
                                                <hr>
                                                <ul class="list-group">
                                                    <?php
                                                    if ($books->num_rows) {
                                                        while ($row = $books->fetch_assoc()) {
                                                            $title = $row['book_name'];
                                                            $isbn = $row['isbn'];
                                                            $price = $row['price'];
                                                            $img = $row['img'];
                                                            $summary = $row['summary'];
                                                            $short_summary = substr($summary, 0, 400);
                                                            $views = $row['view_count'];
                                                            $owner_id = $row['owner_id'];
                                                            $owner = $obj_Core->getUserName($owner_id, $connection);
                                                            ?>
                                                            <li class="list-group-item books">
                                                                <a href="viewbook.php?isbn=<?php echo $isbn; ?>">
                                                                    <div>
                                                                        <div class="col-md-2">
                                                                            <img src="images/uploads/<?php echo $img; ?>" class="books_image">
                                                                        </div>
                                                                        <div class="col-md-10 books_detail">
                                                                            <h4><?php echo $title; ?></h4>
                                                                            <p><?php echo $short_summary; ?></p>
                                                                            <p>Views: <?php echo $views; ?> &nbsp; ISBN: <?php echo $isbn; ?> &nbsp; Owner: <?php echo $owner; ?> </p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li class="list-group-item books">
                                                            <p style="padding-top: 50px; "> No results for this search. Please Try another search. </p>
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


                        <?php include "components/learnMore.php" ?>
                    </div>
                    <!-- searchResults-list -->
                    <!-- ========================= book-detail ========================= end -->
                </body>
            </html>

            <?php
        } else {
            header("location: books.php");
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}