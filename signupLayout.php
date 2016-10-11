<!DOCTYPE html>
<html>
    <head>
        <title>BookBNB</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="Bootstrap/js/jquery.min.js"></script>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            function validate() {
                var name = document.forms["signup"]["username"].value;
                var email = document.forms["signup"]["email"].value;
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
                var password = document.forms["signup"]["password"].value;
                var street = document.forms["signup"]["street"].value;
                var suburb = document.forms["signup"]["suburb"].value;
                var state = document.forms["signup"]["state"].value;
                var postcode = document.forms["signup"]["postcode"].value;
                if (name == null || name == "") {
                    document.getElementById("username").style.borderColor = "#F44336";
                    return false;
                }
                if (!re.test(email)) {
                    document.getElementById("email").style.borderColor = "#F44336";
                    return false;
                }
                if (password == null || password == "" || password.length < 6) {
                    alert("Password should contains atleast 6 letters");
                    document.getElementById("password").style.borderColor = "#F44336";
                    return false;
                }
                if (street == null || street == "") {
                    document.getElementById("street").style.borderColor = "#F44336";
                    return false;
                }
                if (suburb == null || suburb == "") {
                    document.getElementById("suburb").style.borderColor = "#F44336";
                    return false;
                }
                if (state == null || state == "") {
                    document.getElementById("state").style.borderColor = "#F44336";
                    return false;
                }
                if (postcode == null || postcode == "" || postcode.length < 4) {
                    document.getElementById("postcode").style.borderColor = "#F44336";
                    return false;
                }
            }
        </script>
    </head>
    <body style="background-color: #273244 !important;">
        <div class="wrapper" style="margin-top: 200px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" style="display: block;">&times;</button>
                        <h3 class="text-center">SIGN UP</h3>
                        <form class="form form-signup" role="form" action="" method="POST" enctype="multipart/form-data" name="signup" onsubmit="return validate()">
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
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="text" id="street" name="street" class="form-control" placeholder="Street Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="text" id="suburb" name="suburb" class="form-control" placeholder="Suburb" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="text" id="state" name="state" class="form-control" placeholder="State" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="number" id="postcode" name="postcode" class="form-control" placeholder="Postcode" />
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">SUBMIT</button>
                            </div>
                        </form>
                        <p class="bg-danger" style="color: #F44336  !important;">* Email Already Exists !</p>
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