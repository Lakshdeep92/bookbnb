<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logoImage"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <form method="POST" action="searchResults.php" enctype="multipart/form-data">
            <div class="form-group searchDiv">
              <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Enter title or ISBN">
            </div>
        </li>
        <li class="searchButton">
          <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
          
          //require 'class.Core.inc';
          //$obj_Core = new Core();
          //$connection = $obj_Core->connect_Database();
          //$check_Session = $obj_Core->checkSession();
          if($check_Session){
//              $user_id = $_SESSION['user_id'];
//              $username = $obj_Core->getUserName($user_id, $connection);
//              $shortUsername = substr($username, 0, 7);
              ?>
                <li class="linkStyle"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> CART</a></li>
                <li class="linkStyle"><a href="createpost.php"><span class="glyphicon glyphicon-edit"></span> POST</a></li>
                <li class="linkStyle"><a href="profile.php?id=<?php echo $user_id; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $shortUsername; ?></a></li>
                <li class="linkStyle"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>          
              <?php
          }else{
              ?>
                <li class="linkStyle"><a href="#" data-toggle="modal" data-target="#signup-modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li class="linkStyle"><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
               <?php
          }
          ?>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

<?php include "modal.php" ?>
