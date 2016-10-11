<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>BookBNB</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="Bootstrap/js/jquery.min.js"></script>
	<script src="Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

	<?php include "components/navbar.php" ?>

	<?php include "components/carousel-try.php" ?>

	<!-- begin ========================= homepage-recommendations ========================= -->

	<div class="homepage-recommendations">
		<div class="container">
			<h2 class="section-title text-uppercase">Recently Added <a href="books.php"><button type="button" class="btn btn-primary" style="float: right;">More</button></a></h2>
			<p class="section-intro">Not sure what book to read? Maybe follow the recent recommendations would help.</p>
			<div class="row editors-choices">
                            <?php
                                $recent_books = $obj_Core->getRecentBooks($connection);
                                while($recent_results = $recent_books->fetch_assoc()){
                                    $image = $recent_results['img'];
                                    $bookname = $recent_results['book_name'];
                                    $owner_id = $recent_results['owner_id'];
                                    $owner = $obj_Core->getUserName($owner_id, $connection);
                                    $isbn = $recent_results['isbn'];
                                    ?>
                                    <div class="col-md-3">
					<div class="thumbnail">
                                            <a href="viewbook.php?isbn=<?php echo $isbn; ?>" class="bookImage"><img src="images/uploads/<?php echo $image; ?>" style="height: 383px;width: 253px;"></a>
					</div>
					<div class="thumbnail-book-info">
						<h3 class="bookName-homepage"><a href="viewbook.php?isbn=<?php echo $isbn; ?>"><?php echo $bookname; ?></a></h3>
						<p class="bookAuthor-homepage"><a href="profile.php?id=<?php echo $owner_id; ?>" class="bookAuthor-homepage">Owner - <?php echo $owner; ?></a></p>
					</div>
                                    </div>
                                    <?php
                                }
                            ?>
			</div>
		</div>
		<div class="container">
			<h2 class="section-title text-uppercase">Most Popular <a href="books.php"><button type="button" class="btn btn-primary" style="float: right;">More</button></a></h2>
			<p class="section-intro">Most picked books.</p>
			<div class="row editors-choices">
                            <?php
                                $popular_books = $obj_Core->getPopularBooks($connection);
                                while($popular_results = $popular_books->fetch_assoc()){
                                    $image = $popular_results['img'];
                                    $bookname = $popular_results['book_name'];
                                    $owner_id = $popular_results['owner_id'];
                                    $owner = $obj_Core->getUserName($owner_id, $connection);
                                    $isbn = $popular_results['isbn'];
                                    ?>
                                    <div class="col-md-3">
                                            <div class="thumbnail">
                                                <a href="viewbook.php?isbn=<?php echo $isbn; ?>" class="bookImage"><img src="images/uploads/<?php echo $image; ?>" style="height: 383px;width: 253px;"></a>
                                            </div>
                                            <div class="thumbnail-book-info">
                                                    <h3 class="bookName-homepage"><a href="viewbook.php?isbn=<?php echo $isbn; ?>"><?php echo $bookname; ?></a></h3>
                                                    <p class="bookAuthor-homepage"><a href="profile.php?id=<?php echo $owner_id; ?>" class="bookAuthor-homepage">Owner - <?php echo $owner; ?></a></p>
                                            </div>
                                    </div>
                                    <?php
                                }
                            ?>
			</div>
		</div>

		<?php include "components/learnMore.php" ?>
	</div>
	<!-- homepage-recommendations -->

	<!-- ========================= homepage-recommendations ========================= end -->
</body>

</html>
