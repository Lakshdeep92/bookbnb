<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_GET['isbn'])){
            $isbn = $_GET['isbn'];
            $is_isbn_valid = $obj_Core->checkIsbn($isbn, $connection);
            if($is_isbn_valid->num_rows){
                $delete_book = $obj_Core->deleteBook($isbn, $connection);
                if($delete_book){
                    header("location: index.php");
                }else{
                    header("location: books.php");
                }
            }else{
                header("location: books.php");
            }
        }
    }else{
        header("location: index.php");
    }

