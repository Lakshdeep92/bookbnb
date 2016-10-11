<?php
require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_POST)){
            $p_isbn = $_POST['p_isbn'];
            $book = $obj_Core->getBook($p_isbn, $connection);
            $book_id = $book['book_id'];
            $p_bookname = $book['book_name'];
            $p_isbn = $book['isbn'];
            $p_price = $book['price'];
            $p_image = $book['img'];
            $owner_id = $book['owner_id'];
            $date_time = $book['publish_date'];
            $p_summary = $book['summary'];
            $book_summary = substr($summary, 0, 1000);
            $views = $book['view_count'];
            $obj_Core->incrementView($views, $book_id, $connection);
            $status = $book['status'];
            $p_g1photo = $book['g1photo'];
            $p_g2photo = $book['g2photo'];
            $p_g3photo = $book['g3photo'];
            
            if(!empty($_POST['bookname'])){
                $bookname = $_POST['bookname'];
            }else{
                $bookname = $p_bookname;
            }
            if(!empty($_POST['price'])){
                $price = $_POST['price'];
            }else{
                $price = $p_price;
            }
            if(!empty($_POST['bookdescription'])){
                $summary = $_POST['bookdescription'];
            }else{
                $summary = $p_summary;
            }
            if(!empty($_FILES['coverphoto']['name'])){
                $cover = $_FILES['coverphoto']['name'];
                $image = $_FILES['coverphoto']['name'];
                $image_size = $_FILES['coverphoto']['size'];
                $file_tmp =$_FILES['coverphoto']['tmp_name'];
                $file_ext=strtolower(end(explode('.',$image)));
                $expensions= array("jpeg","jpg","png");
                 if(in_array($file_ext,$expensions)=== false){
                    header("location: createpost.php?r=f");
                 }
                  if($image_size > 2097152){
                    header("location: createpost.php?r=f");
                 }
                 $result = move_uploaded_file($file_tmp,"images/uploads/".$image);
            }else{
                $cover = $p_image;
            }
            if(!empty($_FILES['g1photo']['name'])){
                $g1photo = $_FILES['g1photo']['name'];
                $g1photo_size = $_FILES['g1photo']['size'];
                $g1photo_tmp =$_FILES['g1photo']['tmp_name'];
                $g1photo_ext=strtolower(end(explode('.',$g1photo)));
                $expensions= array("jpeg","jpg","png");
                 if(in_array($g1photo_ext,$expensions)=== false){
                    header("location: createpost.php?r=f");
                 }
                  if($g1photo_size > 2097152){
                    header("location: createpost.php?r=f");
                 }
                 $result = move_uploaded_file($g1photo_tmp,"images/uploads/".$g1photo);
            }else{
                $g1photo = $p_g1photo;
            }
            if(!empty($_FILES['g2photo']['name'])){
                $g2photo = $_FILES['g2photo']['name'];
                $g2photo_size = $_FILES['g2photo']['size'];
                $g2photo_tmp =$_FILES['g2photo']['tmp_name'];
                $g2photo_ext=strtolower(end(explode('.',$g2photo)));
                $expensions= array("jpeg","jpg","png");
                 if(in_array($g2photo_ext,$expensions)=== false){
                    header("location: createpost.php?r=f");
                 }
                  if($g2photo_size > 2097152){
                    header("location: createpost.php?r=f");
                 }
                 $result = move_uploaded_file($g2photo_tmp,"images/uploads/".$g2photo);
            }else{
                $g2photo = $p_g2photo;
            }
            if(!empty($_FILES['g3photo']['name'])){
                $g3photo = $_FILES['g3photo']['name'];
                $g3photo_size = $_FILES['g3photo']['size'];
                $g3photo_tmp =$_FILES['g3photo']['tmp_name'];
                $g3photo_ext=strtolower(end(explode('.',$g3photo)));
                $expensions= array("jpeg","jpg","png");
                 if(in_array($g3photo_ext,$expensions)=== false){
                    header("location: createpost.php?r=f");
                 }
                  if($g3photo_size > 2097152){
                    header("location: createpost.php?r=f");
                 }
                 $result = move_uploaded_file($g3photo_tmp,"images/uploads/".$g3photo);
            }else{
                $g3photo = $p_g3photo;
            }
            $query = "UPDATE book_info SET book_name='$bookname',price='$price',img='$cover',summary='$summary',g1photo='$g1photo',g2photo='$g2photo',g3photo='$g3photo' WHERE isbn='$p_isbn'";
            $result = $connection->query($query);
            header("location: viewbook.php?isbn=$p_isbn");
        }else{
            header("location: viewbook.php?isbn=$p_isbn");
        }
    }
?>

