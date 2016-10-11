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
            $image = $_FILES['profileImage']['name'];
            $image_size = $_FILES['profileImage']['size'];
            $file_tmp =$_FILES['profileImage']['tmp_name'];
            $file_ext=strtolower(end(explode('.',$image)));
            $expensions= array("jpeg","jpg","png");
             if(in_array($file_ext,$expensions)=== false){
                header("location: profile.php?id=$user_id&error=1");
             }
              if($image_size > 2097152){
                header("location: profile.php?id=$user_id&error=2");
             }
             $result = move_uploaded_file($file_tmp,"images/profile/".$image);
             if($result){
                 $insertImage = $obj_Core->insertImage($user_id, $image, $connection);
             }
             header("location: profile.php?id=$user_id");
             
        }else{
            header("location: index.php");
        }
    }
?>

