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
            $id_to = $_POST['to'];
            $comment = $_POST['reviewComment'];
            $query = "INSERT INTO user_reviews VALUES ('','$user_id','$id_to','$comment')";
            $result = $connection->query($query);
            if($result){
                header("location: profile.php?id=$id_to");
            }else{
                header("location: profile.php?id=$id_to");
            }
        }else{
            header("location: index.php");
        }
    }
?>

