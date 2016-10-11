<!DOCTYPE html>
<html>
<head>
	<title>TTTTBookBNB</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="Bootstrap/js/jquery.min.js"></script>
	<script src="Bootstrap/js/bootstrap.min.js"></script>
</head>
  <script type="text/javascript">
  function validateLogin(){
    var loginEmail = document.forms["login"]["loginEmail"].value;
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
    var loginPassword = document.forms["login"]["loginPassword"].value;
    if (!re.test(loginEmail)) {
      document.getElementById("loginEmail").style.borderColor = "#F44336";
      return false;
    }
    if( loginPassword == null || loginPassword == ""){
      document.getElementById("loginPassword").style.borderColor = "#F44336";
      return false;
    }
    return true;
  }
  </script>
<body style="background-color: #273244 !important;">
<div class="wrapper" style="margin-top: 200px;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
        <a href="index.php" class="linkStyle"><span class="glyphicon glyphicon-circle-arrow-left" style="font-family: tahoma;"> Back</span></a>
        <h3 class="text-center">LOG IN</h3>
        <form class="form form-signup" role="form" action="" method="POST" enctype="multipart/form-data" name="login" onsubmit="return validateLogin();">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
              </span>
              <input type="text" id="loginEmail" name="loginEmail" class="form-control" placeholder="Email" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" id="loginPassword" name="loginPassword" class="form-control" placeholder="Password" />
            </div>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm btn-block">LOGIN</button>
          </div>
        </form>
        <p class="bg-danger" style="color: #F44336  !important;">Please Check Credentials</p>
      </div>
      <!-- modal-footer -->
      <!-- <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div> -->
    </div>
  </div>
</div>
</body>
</html>