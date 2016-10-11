<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author laksh
 */
class Core {
    //put your code here
    /*
     * this function connect with the database and return connection variable for making queries
     */
    public function connect_Database(){
        $host = "localhost";
        $username = "root";
        $password = "";
        $database_name = "bookbnb";
        $mysqli = new mysqli($host, $username, $password, $database_name);
        return $mysqli;
    }
    
    //this function check that whether this email already existing or not
    public function checkUser($email,$connection){
        $query = "SELECT * FROM user_info WHERE email='$email'";
        $findResult = $connection->query($query);
        return $findResult;
    }
    
    //This function insert new user in to database
    public function insertUser($table, $values){
        $userName = $values['username'];
        $email = $values['email'];
        $password = $values['password'];
        $new_Password = password_hash($password, PASSWORD_DEFAULT);
        $street = $values['street'];
        $suburb = $values['suburb'];
        $state = $values['state'];
        $postcode = $values['postcode'];
        $query = "INSERT INTO user_info VALUES ('','$userName','$new_Password','$street','$suburb','$state','$postcode','$email')";
        return $query;
    }
    
    //this function returns the username of the active user
    public function getUserName($id, $connection){
        $query = "SELECT * FROM user_info WHERE user_id='$id'";
        $getUser = $connection->query($query);
        $userRow = $getUser->fetch_assoc();
        $username = $userRow['username'];
        return $username;
    }
    
    //this function returns the active user id
    public function getId(){
        $check_session = $this->checkSession();
        if($check_session){
            $id = $_SESSION['user_id'];
            return $id;
        }
    }
    
    //this function sets the session and make the user logged in to the website
    public function setSession($id, $username){
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        return true;
    }
    
    //this funcion checks whether the session is set or not
    public function checkSession(){
        session_start();
        if(isset($_SESSION['user_id'])){
            return true;
        }
        return false;
    }
    
    //this function checks the login credentials and logged in user
    public function login($email, $password, $connect){
        $query = "SELECT * FROM user_info WHERE email='$email'";
        $userRow = $connect->query($query);
        if($userRow){
            $userResult = $userRow->fetch_assoc();
            $hash = $userResult['password'];
            $password_match = password_verify($password, $hash);
            if($password_match){
                $id = $userResult['user_id'];
                $username = $userResult['username'];
                $this->setSession($id, $username);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    //this function created new post or add new book
    public function createPost($table, $values){
        $book_name = $values['bookname'];
        $isbn = $values['isbn'];
        $price = $values['price'];
        $bookdescription = $values['bookdescription'];
        $image = $_FILES['coverphoto']['name'];
        $user_id = $this->getId();
        $time = date('l jS \of F Y h:i:s A');
        $view_count = "1";
        $status = "1";
        if(!empty($_FILES['g1photo']['name'])){
            $g1photo = $_FILES['g1photo']['name'];
        }else{
            $g1photo = NULL;
        }
        if(!empty($_FILES['g2photo']['name'])){
            $g2photo = $_FILES['g2photo']['name'];
        }else{
            $g2photo = NULL;
        }
        if(!empty($_FILES['g3photo']['name'])){
            $g3photo = $_FILES['g3photo']['name'];
        }else{
            $g3photo = NULL;
        }
        $query = "INSERT INTO book_info VALUES ('','$book_name','$isbn','$price','$image','$user_id','$time','$bookdescription','$view_count','$status','$g1photo','$g2photo','$g3photo')";
        return $query;        
    }

    //this function checks that is the isbn number is inserted before or avoid redundancy
    public function checkIsbn($isbn, $connection){
        $query = "SELECT * FROM book_info WHERE isbn='$isbn'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function finds the book related to that isbn and send back to the viewbook page for showing that book
    public function getBook($isbn, $connection){
        $query = "SELECT * FROM book_info WHERE isbn='$isbn'";
        $result = $connection->query($query);
        $book = $result->fetch_assoc();
        return $book;
    }
    
    //this function deletes the book
    public function deleteBook($isbn, $connection){
        $query = "DELETE FROM book_info WHERE isbn='$isbn'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function checks is the book id valid
    public function checkBookId($id, $connection){
        $query = "SELECT * FROM book_info WHERE book_id='$id'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function adds a comment regarding that book
    public function addComment($values, $connection){
        $book_id = $values['book_id'];
        $comment = $values['bookComment'];
        $user_id = $this->getId();
        $date_time = date('l jS \of F Y h:i:s A');
        $query = "INSERT INTO book_comments VALUES('','$book_id','$user_id','$comment','$date_time','0','0')";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function get all the comments related to that book
    public function getComments($book_id, $connection){
        $query = "SELECT * FROM book_comments WHERE book_id='$book_id'";
        $getcomments = $connection->query($query);
        return $getcomments;
    }
    
    //this function checks whether the logged in user and user who comments are same or not
    public function isCommentOwner($user_id, $comment_user_id){
        if($user_id == $comment_user_id){
            return true;
        }
        return false;
    }
    
    //this function gives the most viewed books 
    public function getMostViewedBooks($connection){
        $query = "SELECT * FROM book_info ORDER BY view_count DESC LIMIT 0,3";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function increment the view count
    public function incrementView($count, $id, $connection){
        $new_count = $count+1;
        $sql = "UPDATE book_info SET view_count='$new_count' WHERE book_id='$id'";
        $result = $connection->query($sql);
    }
    
    //this function returns all the books
    public function getAllBooks($connection){
        $query = "SELECT * FROM book_info WHERE status='1'";
        $getBooks = $connection->query($query);
        return $getBooks;
    }
    
    //this function give back one book
    public function getCartBook($book_id, $connection){
        $query = "SELECT * FROM book_info WHERE book_id='$book_id'";
        $book = $connection->query($query);
        return $book;
    }
    
    //this function created the order
    public function createOrder($cardnumber, $cvv, $expiry, $firstname, $lastname, $address, $email ,$price, $connection){
        $owner_id =  $this->getId();
        $cardnumber = password_hash($cardnumber, PASSWORD_DEFAULT);
        $owner = $this->getUserName($owner_id, $connection);
        $query = "INSERT INTO orders VALUES ('','$cardnumber','$cvv','$expiry','$firstname','$lastname','$address','$price','$owner','$email')";
        $result = $connection->query($query);
        unset($_SESSION['items']);
        $to = $email;
        $subject = "Sucessfull Order";

        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>This email contains HTML Tags!</p>
        <table style='width: 70%;border: 1px solid #273244;'>
        <tr style='color: #fff;background-color: #273244;'>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Email</td>
            <td>Address</td>
            <td>Amount</td>
        </tr>
        <tr>
            <td>$firstname;</td>
            <td>$lastname;</td>
            <td>$email;</td>
            <td>$address;</td>
            <td>$price;</td>
        </tr>                                    
        </table>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no-reply@bookbnb.com>' . "\r\n";

        mail($to,$subject,$message,$headers);
        return $result;
    }
    
    //this function search the books according to provided search variable
    public function searchBooks($search, $connection){
        $query = "SELECT * FROM book_info WHERE book_name LIKE '%$search%' OR isbn LIKE '%$search%'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function returns the books that has been posted recently
    public function getRecentBooks($connection){
        $query = "SELECT * FROM book_info ORDER BY book_id DESC LIMIT 0,4";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function returns the books the most viewed books
    public function getPopularBooks($connection){
        $query = "SELECT * FROM book_info ORDER BY view_count DESC LIMIT 0,4";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function returns books of specific user
    public function getUserBooks($user_id, $connection){
        $query = "SELECT * FROM book_info WHERE owner_id='$user_id'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function returns reviews given to that user
    public function  getReviews($id, $connection){
        $query = "SELECT * FROM user_reviews WHERE comment_to ='$id'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function returns full row of the user
    public function getUser($id, $connection){
        $query = "SELECT * FROM user_info WHERE user_id='$id'";
        $user = $connection->query($query);
        $userRow = $user->fetch_assoc();
        return $userRow;
    }
    
    //this function check whether the user has already profile image
    public function hasImage($id, $connection){
        $query = "SELECT * FROM user_image WHERE user_id='$id'";
        $result = $connection->query($query);
        return $result;
    }
    
    //this function will upload the profile image of the user into database
    public function insertImage($id, $image, $connection){
        $hasImage = $this->hasImage($id, $connection);
        if($hasImage){
            $query = "UPDATE user_image SET image='$image' WHERE user_id='$id'";
            $result = $connection->query($query);
        }else{
            $query = "INSERT INTO user_image VALUES('$id','$image')";
            $result = $connection->query($query);
        }
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    //this function returns the name of user profile image
    public function getImage($id, $connection){
        $query = "SELECT * FROM user_image WHERE user_id='$id'";
        $result = $connection->query($query);
        if($result->num_rows){
            $imageRow = $result->fetch_assoc();
            $name = $imageRow['image'];
        }else{
            $name = "nobody.jpg";
        }
        return $name;
    }
    
    //this function returns the count of total posts posted by the user
    public function getPostCount($id, $connection){
        $query = "SELECT * FROM book_info WHERE owner_id='$id'";
        $result = $connection->query($query);
        $count = $result->num_rows;
        return $count;
    }
    
    //this function returns the count of reviews received by user
    public function getReviewsCount($id, $connection){
        $query = "SELECT * FROM user_reviews WHERE comment_to='$id'";
        $result = $connection->query($query);
        $count = $result->num_rows;
        return $count;
    }
}

