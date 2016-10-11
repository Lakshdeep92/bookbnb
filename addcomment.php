<?php
    require 'class.Core.inc';
    $obj_Core = new Core();
    $connection = $obj_Core->connect_Database();
    $check_Session = $obj_Core->checkSession();
    if($check_Session){
        $user_id = $_SESSION['user_id'];
        $username = $obj_Core->getUserName($user_id, $connection);
        $shortUsername = substr($username, 0, 7);
        if(isset($_POST['book_id'])){
            $id = $_POST['book_id'];
            $isbn = $_POST['book_isbn'];
            $is_id_valid = $obj_Core->checkBookId($id, $connection);
            if($is_id_valid->num_rows){
                $add_comment = $obj_Core->addComment($_POST, $connection);
                if($add_comment){
                    header("location: viewbook.php?isbn=$isbn");
                }else{
                    header("location: viewbook.php?isbn=$isbn");
                }
            }else{
                header("location: books.php");
            }
        }else{
            header("location: books.php");
        }
    }else{
        header("location: index.php");
    }

