<?php
require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $isbn = $_GET['isbn'];
            $query = "DELETE FROM book_comments WHERE comment_id='$id'";
            $result = $connection->query($query);
            header("location: viewbook.php?isbn=$isbn");
        }else{
            header("location: books.php");
        }
    }

