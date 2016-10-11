<?php
session_start();
if(isset($_POST['id'])){
    $book_id = $_POST['id'];
    if(isset($_SESSION['items'])){
        $old_item = $_SESSION['items'];
        if(in_array($book_id, $old_item)){
            echo "Already exists in Cart";
            exit;
        }else{
            array_push($old_item, $book_id);
            $_SESSION['items'] = $old_item;
            echo "Item Added to Cart";
            
        }
    }else{
        $items = array();
        array_push($items, $book_id);
        $_SESSION['items'] = $items;
        echo "Item added to Cart";
    }
}else{
    $id = $_GET['id'];
    $old_item = $_SESSION['items'];
    $key = array_search($id, $old_item);
    unset($old_item[$key]);
    $_SESSION['items'] = $old_item;
    header("location: cart.php");
}