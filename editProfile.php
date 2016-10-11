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
            $getUserRow = $obj_Core->getUser($user_id, $connection);
            if(empty($_POST['street'])){
                $street = $getUserRow['street'];
            }else{
                $street = $_POST['street'];
            }
            
            if(empty($_POST['suburb'])){
                $suburb = $getUserRow['suburb'];
            }else{
                $suburb = $_POST['suburb'];
            }
            
            if(empty($_POST['state'])){
                $state = $getUserRow['state'];
            }else{
                $state = $_POST['state'];
            }
            
            if(empty($_POST['postcode'])){
                $postcode = $getUserRow['postcode'];
            }else{
                $postcode = $_POST['postcode'];
            }
            
            $query = "UPDATE user_info SET street='$street',suburb='$suburb',state='$state',postcode='$postcode' WHERE user_id='$user_id'";
            $result = $connection->query($query);
            header("location: profile.php?id=$user_id");
            
        }else{
            header("location: profile.php?id=$user_id");
        }
    }
?>

