<script type="text/javascript">

function validate(){
  var name = document.forms["signup"]["username"].value;
  var email = document.forms["signup"]["email"].value;
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
  var password = document.forms["signup"]["password"].value;
  var street = document.forms["signup"]["street"].value;
  var suburb = document.forms["signup"]["suburb"].value;
  var state = document.forms["signup"]["state"].value;
  var postcode = document.forms["signup"]["postcode"].value;
  if( name== null || name == ""){
    document.getElementById("username").style.borderColor = "#F44336";
    return false;
  }
  if (!re.test(email)) {
    document.getElementById("email").style.borderColor = "#F44336";
    return false;
  }
  if( password== null || password == "" || password.length < 6){
    alert("Password should contains atleast 6 letters");
    document.getElementById("password").style.borderColor = "#F44336";
    return false;
  }
  if( street== null || street == ""){
    document.getElementById("street").style.borderColor = "#F44336";
    return false;
  }
  if( suburb== null || suburb == ""){
    document.getElementById("suburb").style.borderColor = "#F44336";
    return false;
  }
  if( state== null || state == ""){
    document.getElementById("state").style.borderColor = "#F44336";
    return false;
  }
  if( postcode== null || postcode == "" || postcode.length < 4 ){
    document.getElementById("postcode").style.borderColor = "#F44336";
    return false;
  }
}

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
<div id="login-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
        <h3 class="text-center">LOG IN</h3>
        <form class="form form-signup" role="form" action="login.php" method="POST" enctype="multipart/form-data" name="login" onsubmit="return validateLogin();">
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
      </div>
    </div>
  </div>
</div>
<div id="signup-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
        <h3 class="text-center">SIGN UP</h3>
        <form class="form form-signup" role="form" action="signup.php" method="POST" enctype="multipart/form-data" name="signup" onsubmit="return validate()">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
              <input type="text" id="email" name="email" class="form-control glyphicon glyphicon-ok" placeholder="Email" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-road"></span></span>
              <input type="text" id="street" name="street" class="form-control" placeholder="Street Name" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
              <input type="text" id="suburb" name="suburb" class="form-control" placeholder="Suburb" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-tree-conifer"></span></span>
              <input type="text" id="state" name="state" class="form-control" placeholder="State" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></span>
              <input type="number" id="postcode" name="postcode" class="form-control" placeholder="Postcode" />
            </div>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm btn-block">SUBMIT</button>
          </div>
        </form>
      </div>
      <!-- modal-footer -->
      <!-- <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div> -->
    </div>
  </div>
</div>
