<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        
        if(!empty($_POST)){
            $isbn = $_POST['isbn'];
            $check_isbn = $obj_Core->checkIsbn($isbn, $connection);
            if($check_isbn->num_rows){
                header("location: createpost.php?r=f");
            }else{
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
                }
                                               
                $addNewQuery = $obj_Core->createPost("book_info", $_POST);
                $createPost = $connection->query($addNewQuery);
                if($createPost){
                    header("location: viewbook.php?isbn=$isbn");
                }else{
                    header("location: createpost.php?r=f");
                }
            }
        }else{
            
        }
    }else{
        
    }
?>
