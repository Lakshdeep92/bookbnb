<?php
require 'class.Core.inc';
$obj_Core = new Core();
$connection = $obj_Core->connect_Database();
$check_Session = $obj_Core->checkSession();
if($check_Session){
    session_destroy();
    header("location: index.php");
}else{
    header("location: index.php");
}
?>