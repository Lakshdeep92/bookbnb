<?php
require 'class.Core.inc';
$obj_Core = new Core();
$connect = $obj_Core->connect_Database();
$check_Session = $obj_Core->checkSession();
if($check_Session){
    header("location: index.php");
}else{
 if(!empty($_POST)){
   $email = $_POST['loginEmail'];
   $password = $_POST['loginPassword'];
       
   $loginUser = $obj_Core->login($email, $password, $connect);
   if($loginUser){
       header("location: index.php");
   }else{
       echo file_get_contents('loginLayout.php');
   }
}else{
    echo file_get_contents('loginLayout.php');
}  
}


?>
