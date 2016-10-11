<?php
require 'class.Core.inc';
$obj_Core = new Core();
//making a connection with the database
$connection = $obj_Core->connect_Database();
$check_Session = $obj_Core->checkSession();
if($check_Session){
    header("location: index.php");
}else{
    if(!empty($_POST)){
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $street = $_POST['street'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    
    
    //checking user against the email input 
    $checkUser = $obj_Core->checkUser($email, $connection);
    if($checkUser->num_rows){
        echo file_get_contents('signupLayout.php');
    }else{
        //inserting the new user
        $insert_query = $obj_Core->insertUser("user_info", $_POST);
        $query = $connection->query($insert_query);
        if($query){
            //getting the last inserted id from database for using in session
            $last_id = $connection->insert_id;
            //getting the username
            $get_user_name = $obj_Core->getUserName($last_id, $connection);
            //setting the session
            $set_session = $obj_Core->setSession($last_id, $get_user_name);
            if($set_session){
                header("location: index.php");
            }
        }else{
            echo file_get_contents('signupLayout.php');
        }
    }  
    }else{
        echo file_get_contents('signupLayout.php');
    }
}

?>