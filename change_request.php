<?php 
session_start();
include("connection.php");

if(isset($_POST['go'])){
  $crtype= $_POST['crtype'];
  if($crtype == 'Add/Update User'){
    header("location: user_cr.php");
  }
  elseif ($crtype == 'Add/Update Project') {
    header("location: project_cr.php");
  }
  elseif ($crtype == 'Add/Update Station') {
    header("location: station_cr.php");
  }
  else{
    echo "<script> alert('Invalid CR Type!'); </script>";
  }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Change Request Screen</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/bootstrap/css/bootstrap.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/iconic/css/material-design-iconic-font.min.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/css-hamburgers/hamburgers.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/animsition/css/animsition.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/select2/select2.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/daterangepicker/daterangepicker.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util2.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!--===============================================================================================-->
  </head>

  <body>
    <div id="full_login" class="limiter">
      <div
        class="container-login100">      >
        <div class="wrap-login100">
          <form id="form" class="login100-form validate-form" action="" method="post">
            <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
             Change Request
            </span>

            <div class="wrap-input100 input100-select">
            <span class="label-input100"></span>
            <div>
              <select id="crtype" name="crtype" class="selection-2">
                <option>Select CR Type</option>
                <option>Add/Update User</option>
                <option>Add/Update Project</option>
                <option>Add/Update Station</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

            <div class="container-login100-form-btn">
              <button id="submit" class="login100-form-btn" name="go">
                 Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
      $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $("#dropDownSelect1")
      });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/test.js"></script>
  </body>
</html>
